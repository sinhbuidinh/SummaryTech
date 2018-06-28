<?php
namespace App\Services;

use App\Services\BaseService;
use App\Repositories\CustomerRepository;

class CustomerService extends BaseService
{
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
    }

    public function processData($request)
    {
        $request_data = $request->all();

        $this->initVariable($this->form_name, $this->attr_accessor, $this->default_params);
        $data[$this->form_name] = $this->initFormData();

        $last_data = array_merge($data, $request_data);
        $last_data['form_name'] = $this->form_name;

        return $last_data;
    }
}
