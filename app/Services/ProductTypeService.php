<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\ProductTypeRepository;

class ProductTypeService extends BaseService
{
    private $product_type_repository;

    public function __construct()
    {
        $this->attr_accessor = [
            'name',
        ];

        $this->default_params = [
            'name' => '',
        ];

        $this->form_name = 'product_type_form';

        $this->product_type_repository = new ProductTypeRepository();
    }

    public function processData($request)
    {
        $request_data = $request->all();

        $this->initVariable($this->form_name, $this->attr_accessor, $this->default_params);
        $data[$this->form_name] = $this->initFormData();

        $last_data = array_merge($data, $request_data);
        $last_data['form_name'] = $this->form_name;

        //load list product type before
        $list_product_type = $this->getListProductType();
        $last_data['list_product_type_old'] = $list_product_type;

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
                $result_insert = $this->insertProductType($form_data);
                $last_data['message'] = $result_insert['message'];
            }
        }

        return $last_data;
    }

    public function getListProductType($order = [])
    {
        $product_type = $this->product_type_repository->listAll($order)->toArray();
        return $product_type;
    }

    private function insertProductType($product_form_data)
    {
        //array only attr_accessor
        $data_insert = array_only($product_form_data, $this->attr_accessor);

        return $this->product_type_repository->insertOrUpdate($data_insert);
    }

    private function validateFormData($product_form_data)
    {
        $result = [
            'result'  => true,
            'message' => []
        ];

        if (empty($product_form_data['name'])) {
            $result['result'] = false;
            $result['message'][MESSAGE_TYPE_ERROR][$this->form_name.'_name'] = 'Nhập tên loại ván';
        }

        return $result;
    }
}