<?php
namespace App\Services;

use App\Services\BaseService;
use App\Repositories\CustomerRepository;
use Exception;

class CustomerService extends BaseService
{
    private $customer_repository;
    private $member_service;

    public function __construct()
    {
        $this->attr_accessor = [
            'id',
            'company_name',
            'short_name',
            'address',
            'telephone',
            'business_member',
            'contact_info',
            'debt',
        ];

        $this->default_params = [
            'company_name' => '',
            'short_name' => '',
            'address' => '',
            'telephone' => '',
            'business_member' => 0,
            'contact_info' => '',
            'debt' => 30,
        ];

        $this->form_name = 'customer_form';

        $this->customer_repository = new CustomerRepository();
        $this->member_service = getService('member_service');
    }

    public function deleteCustomer($customer_id)
    {
        $result = $this->customer_repository->delete($customer_id);
        if ($result > 0) {
            return true;
        }

        return false;
    }

    public function listCustomer()
    {
        $data['list'] = $this->customer_repository->listAll();

        return $data;
    }

    public function processData($request)
    {
        $request_data = $request->all();

        $customer_id = $request_data['customer_id']?? null;
        if (!empty($customer_id)) {
            $is_edit = true;
            $this->identifyDefaultEdit($customer_id);
        }

        $this->initVariable($this->form_name, $this->attr_accessor, $this->default_params);
        $data[$this->form_name] = $this->initFormData();

        $last_data = array_merge($data, $request_data);

        $last_data['member_list'] = $this->member_service->listMember();
        $last_data['form_name']   = $this->form_name;

        if (!empty($last_data[$this->form_name])
            && $request->isMethod('post')
        ) {
            //insert data
            //check form data & insert
            $form_data = $last_data[$this->form_name];
            $result_validate = $this->validateFormData($form_data);

            if (!empty($result_validate['message'])) {
                $last_data['message'] = $result_validate['message'];
            }

            if ($result_validate['result'] == true) {
                $result_insert = $this->insertCustomer($form_data);
                $last_data['message']       = $result_insert['message'];
                $last_data['result_insert'] = $result_insert['result'];
            }
        }

        $last_data['is_edit'] = $is_edit?? false;

        return $last_data;
    }

    private function identifyDefaultEdit($customer_id)
    {
        //is_edit
        $customer_info = $this->getCustomerById($customer_id)->toArray();
        $this->default_params = $customer_info;
    }

    public function getCustomerById($id)
    {
        $customer_list = $this->customer_repository->listAll([$id]);
        if (blank($customer_list)) {
            throw new Exception('customer_id không hợp lệ!!!');
        }

        $customer = $customer_list->first();

        return $customer;
    }

    private function insertCustomer($customer_form_data)
    {
        //array only attr_accessor
        $data_insert = array_only($customer_form_data, $this->attr_accessor);

        return $this->customer_repository->insertOrUpdate($data_insert);
    }

    private function validateFormData($customer_form_data)
    {
        $result = [
            'result'  => true,
            'message' => []
        ];

        if (empty($customer_form_data['company_name'])) {
            $result['result'] = false;
            $result['message'][MESSAGE_TYPE_ERROR][$this->form_name.'_company_name'] = 'Nhập tên công ty';
        }

        if (empty($customer_form_data['address'])) {
            $result['result'] = false;
            $result['message'][MESSAGE_TYPE_ERROR][$this->form_name.'_address'] = 'Nhập địa chỉ công ty';
        }

        if (empty($customer_form_data['telephone'])) {
            $result['result'] = false;
            $result['message'][MESSAGE_TYPE_ERROR][$this->form_name.'_telephone'] = 'Nhập điện thoại công ty';
        }

        if (empty($customer_form_data['contact_info'])) {
            $result['result'] = false;
            $result['message'][MESSAGE_TYPE_ERROR][$this->form_name.'_contact_info'] = 'Nhập thông tin liên hệ';
        }

//        if (empty($customer_form_data['business_member'])) {
//            $result['result'] = false;
//            $result['message'][MESSAGE_TYPE_ERROR][$this->form_name.'_business_member'] = 'Chọn nhân viên phụ trách';
//        }

        return $result;
    }
}
