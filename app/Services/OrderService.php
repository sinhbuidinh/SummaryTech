<?php
namespace App\Services;

use App\Services\BaseService;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService extends BaseService
{
    private $order_repository;
    private $order_product_repository;
    private $customer_repository;
    private $customer_service;
    private $product_service;

    public function __construct()
    {
        $this->attr_accessor = [
            'date_create',
            'date_export',
            'customer_id',
            'address_delivery',
            'contact_info',
            'number',
            'unit',
            'have_vat',
            'total',
            'total_all'
        ];

        $this->default_params = [
            'date_create' => dateToday(true, DATE_FORMAT_YMD_SUB),
            'date_export' => dateToday(true, DATE_FORMAT_YMD_SUB),
            'total_all' => [
                'number' => 0,
                'total' => 0
            ]
        ];

        $this->form_name = 'order_form';

        $this->customer_repository      = new CustomerRepository();
        $this->order_repository         = new OrderRepository();
        $this->order_product_repository = new OrderProductRepository();

        $this->customer_service = getService('customer_service');
        $this->product_service  = getService('product_service');
    }
    
    public function getOrderList()
    {
        $order_list = $this->order_repository->listAll();
        dd($order_list);
    }

    public function processData($request)
    {
        $request_data = $request->all();

        $this->initVariable($this->form_name, $this->attr_accessor, $this->default_params);
        $data[$this->form_name] = $this->initFormData();

        $last_data = array_merge($data, $request_data);
        $last_data['form_name'] = $this->form_name;

        if (!empty($last_data[$this->form_name])
            && $request->isMethod('post')
        ) {
            //check form data & insert
            $form_data = $last_data[$this->form_name];
            $result_validate = $this->validateFormData($form_data);

            if (!empty($result_validate['message'])) {
                $last_data['message'] = $result_validate['message'];
            }

            if ($result_validate['result'] == true) {
                $result_insert = $this->insertOrderData($form_data);
                $last_data['message']       = $result_insert['message'];
                $last_data['result_insert'] = $result_insert['result'];
            }
        }

        $last_data['list_customer'] = $this->loadListCustomer();
        $last_data['products'] = $this->loadListProduct();
        $last_data['have_vat_list'] = $this->loadListVat();

        return $last_data;
    }
    
    private function insertOrderData($order_form_data)
    {
        //array only attr_accessor
        $data_insert = array_only($order_form_data, $this->attr_accessor);

        try {
            DB::beginTransaction();
            //insert order data
            $result_order = $this->insertOrder($data_insert);
            if ($result_order['result'] == false) {
                throw new Exception('insert order fail');
            }

            $data_insert['order_id'] = $result_order['insert_id'];
            if ($data_insert['order_id'] == null) {
                throw new Exception('Can not get order_id for create order_product');
            }

            //order product
            $result_order_product = $this->insertOrderProducts($data_insert);
            if ($result_order_product == false) {
                throw new Exception('insert order_product fail');
            }

            DB::commit();
            return [
                'message' => [
                    MESSAGE_TYPE_SUCCESS => 'Insert order success'
                ],
                'result'  => true
            ];
        } catch (Exception $ex) {
            DB::rollBack();
            return [
                'message' => [
                    MESSAGE_TYPE_ERROR => $ex->getMessage()
                ],
                'result'  => false
            ];
        }
    }

    private function insertOrder($data_insert)
    {
        //from customer -> member order
        $customer_info = $this->customer_repository
                              ->findByIds([
                                  $data_insert['customer_id']
                              ])
                              ->first();
        $member_id = $customer_info->business_member;

        $order_data = [
            "date_create"      => $data_insert['date_create'],
            "date_export"      => $data_insert['date_export'],
            "customer_id"      => $data_insert['customer_id'],
            "address_delivery" => $data_insert['address_delivery'],
            "contact_info"     => $data_insert['contact_info'],
            "total_all_number" => $data_insert['total_all']['number']?? 0,
            "total_all_price"  => $data_insert['total_all']['total'],
            "member_id"        => $member_id
        ];

         //insert orders by order_data above
        $result_order = $this->order_repository->insertOrUpdate($order_data);

        return $result_order;
    }

    private function insertOrderProducts($data_insert)
    {
        $order_products = $this->getOrderProductInForm($data_insert);

        //insert by list order_products above
        if (!empty($order_products)) {
            foreach ($order_products as $order_product) {
                $result_order_product = $this->order_product_repository->insertOrUpdate($order_product);

                if ($result_order_product['result'] == false) {
                    return false;
                }
            }

            return true;
        }

        return false;
    }

    private function getOrderProductInForm($data_insert)
    {
        $numbers   = $data_insert['number'];
        $units     = $data_insert['unit'];
        $totals    = $data_insert['total'];
        $have_vats = $data_insert['have_vat'];

        $vat_list = $this->loadListVat(CONFIG_ARR_BY_KEY, CONFIG_ARR_BY_CODE);

        $order_products = [];
        foreach ($totals as $product_id => $total) {
            if ($total <= 0) {
                continue;
            }

            $order_products[] = [
                'order_id' => $data_insert['order_id'],
                'product_id' => $product_id,
                'number' => $numbers[$product_id] ?? 0,
                'unit'   => $units[$product_id] ?? 0,
                'total'  => $total,
                'is_vat' => $have_vats['have_vat'] ?? $vat_list['not_have']
            ];
        }

        return $order_products;
    }

    private function loadListVat($key = CONFIG_ARR_BY_CODE, $val = CONFIG_ARR_BY_NAME)
    {
        $have_vat = getKubunCustom('division.product', 'have_vat', $key, $val);

        return $have_vat;
    }

    private function loadListCustomer()
    {
        $list_customer = $this->customer_service->listCustomer();

        return $list_customer['list'];
    }

    private function loadListProduct()
    {
        $list_product = $this->product_service->listProduct();
        return $list_product;
    }

    private function validateFormData($order_form_data)
    {
        $result = [
            'result'  => true,
            'message' => []
        ];

        if (empty($order_form_data['customer_id'])) {
            $result['result'] = false;
            $result['message'][MESSAGE_TYPE_ERROR][$this->form_name.'_customer_id'] = 'Chọn khách hàng';
        }

        return $result;
    }
}
