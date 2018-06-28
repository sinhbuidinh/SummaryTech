<?php
namespace App\Services;

use App\Services\BaseService;
use App\Repositories\CustomerRepository;

class CustomerService extends BaseService
{
    private $customer_repository;

    public function __construct()
    {
        $this->attr_accessor = [
            'company_name',
            'short_name',
            'address',
            'telephone',
            'business_member',
            'contact_info',
        ];

        $this->default_params = [
            'company_name' => '',
            'short_name' => '',
            'address' => '',
            'telephone' => '',
            'business_member' => 0,
            'contact_info' => '',
        ];

        $this->form_name = 'customer_form';

        $this->customer_repository = new CustomerRepository();
    }

    public function listCustomer()
    {
        $data['list'] = $this->customer_repository->listAll();

        return $data;
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

        return $last_data;
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

        return $result;
    }
}
