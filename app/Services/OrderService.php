<?php
namespace App\Services;

use App\Services\BaseService;
use App\Repositories\OrderRepository;

class OrderService extends BaseService
{
    private $order_repository;
    private $customer_service;
    private $product_service;

    public function __construct()
    {
        $this->attr_accessor = [
            'date_create',
            'date_export',
            'customer_id',
            'contact_info',
            'address_delivery',
            'contact_info',
            'total',
            'total_all',
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

        $this->order_repository = new OrderRepository();
        $this->customer_service = getService('customer_service');
        $this->product_service  = getService('product_service');
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
//                $result_insert = $this->insertMember($form_data);
//                $last_data['message']       = $result_insert['message'];
//                $last_data['result_insert'] = $result_insert['result'];
            }
        }
//        dd($last_data, old($this->form_name));

        $last_data['list_customer'] = $this->loadListCustomer();
        $last_data['products'] = $this->loadListProduct();
        $last_data['have_vat_list'] = $this->loadListVat();

        return $last_data;
    }
    
    private function loadListVat()
    {
        $key = CONFIG_ARR_BY_CODE;
        $val = CONFIG_ARR_BY_NAME;
        
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
