<?php

namespace App\Services;

use App\Services\BaseService;
use \App\Repositories\ProductRepository;

class ProductService extends BaseService
{
    private $product_repository;

    public function __construct()
    {
        $this->attr_accessor = [
            'deck_type',
            'owner',
            'color',
            'unit_size',
            'length',
            'width',
            'height'
        ];

        $this->default_params = [
            'deck_type' => 0,
            'owner' => 0,
            'color' => 0,
            'unit_size' => 'mm',
            'length' => 0,
            'width' => 0,
            'height' => 0
        ];

        $this->form_name = 'product_form';

        $this->product_repository = new ProductRepository();
    }

    public function processData($request)
    {
        $request_data = $request->all();

        $this->initVariable($this->form_name, $this->attr_accessor, $this->default_params);
        $data[$this->form_name] = $this->initFormData();

        $last_data = array_merge($data, $request_data);

        if (!empty($last_data[$this->form_name])) {
            //check form data & insert
            $form_data = $last_data[$this->form_name];
            $result_validate = $this->validateFormData($form_data);

            if (!empty($result_validate['message'])) {
                $last_data['message'] = $result_validate['message'];
            }

            if ($result_validate['result'] == true) {
                $this->insertProduct($form_data);
            }
        }

        return $last_data;
    }

    private function insertProduct($product_form_data)
    {
        //array only attr_accessor
        $data_insert = array_only($product_form_data, $this->attr_accessor);

        $this->product_repository->insertOrUpdate($data_insert);
    }

    private function validateFormData($product_form_data)
    {
//        'deck_type',
//        'owner',
//        'color',
//        'length',
//        'width',
//        'height'
        $result = [
            'result'  => true,
            'message' => []
        ];

        if (empty($product_form_data['deck_type'])) {
            $result['result'] = false;
            $result['message'][MESSAGE_TYPE_ERROR]['product_form_deck_type'] = 'Chọn loại ván';
        }

        return $result;
    }
}