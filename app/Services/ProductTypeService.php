<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\ProductTypeRepository;
use Exception;

class ProductTypeService extends BaseService
{
    private $product_type_repository;

    public function __construct()
    {
        $this->attr_accessor = [
            'id',
            'name',
        ];

        $this->default_params = [
            'name' => '',
        ];

        $this->form_name = 'product_type_form';

        $this->product_type_repository = new ProductTypeRepository();
    }
    
    public function getProductTypeById($id)
    {
        $product_type_list = $this->product_type_repository->listAll([$id]);
        $product_type = $product_type_list->first();

        return $product_type;
    }
    
    private function identifyDefaultEdit($product_type_id)
    {
        //is_edit
        $product_type_info = $this->getProductTypeById($product_type_id);
        if (!empty($product_type_info)) {
            $this->default_params = $product_type_info->toArray();
        } else {
            throw new Exception('Product_type_id không hợp lệ!!!');
        }
    }

    public function processData($request)
    {
        $request_data = $request->all();

        $product_type_id = $request_data['product_type_id']?? null;
        if (!empty($product_type_id)) {
            $is_edit = true;
            $this->identifyDefaultEdit($product_type_id);
        }

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
                $last_data['result_insert'] = $result_insert['result'];
            }
        }
        
        $last_data['is_edit'] = $is_edit?? false;

        return $last_data;
    }

    public function getListProductType($id = [], $order = [])
    {
        $product_type = $this->product_type_repository->listAll($id, $order)->toArray();
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