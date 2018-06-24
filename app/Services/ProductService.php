<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\ProductRepository;

class ProductService extends BaseService
{
    private $product_repository;
    private $product_type_service;

    public function __construct()
    {
        $this->attr_accessor = [
            'deck_type',
            'code_name',
            'is_foreign',
            'color',
            'unit_size',
            'length',
            'width',
            'height'
        ];

        $this->default_params = [
            'deck_type' => 0,
            'code_name' => '',
            'is_foreign' => 0,
            'color' => 0,
            'unit_size' => 'mm',
            'length' => 0,
            'width' => 0,
            'height' => 0
        ];

        $this->form_name = 'product_form';

        $this->product_repository = new ProductRepository();
        $this->product_type_service = getService('product_type_service');
    }

    public function processData($request)
    {
        $request_data = $request->all();

        $this->initVariable($this->form_name, $this->attr_accessor, $this->default_params);
        $data[$this->form_name] = $this->initFormData();

        $last_data = array_merge($data, $request_data);
        $last_data['form_name'] = $this->form_name;

        $order = [
            '`order` DESC'
        ];
        $last_data['product_type_list'] = $this->product_type_service->getListProductType($order);

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
                $result_insert = $this->insertProduct($form_data);
                $last_data['message'] = $result_insert['message'];
            }
        }

        return $last_data;
    }

    public function listProduct()
    {
        $data['list'] = $this->product_repository->listAll();
        $data['product_color'] = $this->getProductColorList();
        $data['product_come_from'] = $this->getForeignLang();
        $data['deck_type'] = $this->getDeckType();

        return $data;
    }

    private function getDeckType()
    {
        $deck_type = $this->product_type_service->getListProductType();

        $result = [];
        foreach ($deck_type as $val) {
            $result[$val['id']] = $val;
        }

        return $result;
    }

    private function getForeignLang()
    {
        $key = CONFIG_ARR_BY_CODE;
        $val = CONFIG_ARR_BY_NAME;

        $product_come_from = getKubunCustom('division.product', 'product_come_from', $key, $val);

        return $product_come_from;
    }

    private function getProductColorList()
    {
        $key = CONFIG_ARR_BY_CODE;
        $val = CONFIG_ARR_BY_NAME;

        $product_color = getKubunCustom('division.product', 'product_color', $key, $val);

        return $product_color;
    }

    private function insertProduct($product_form_data)
    {
        //array only attr_accessor
        $data_insert = array_only($product_form_data, $this->attr_accessor);

        $this->product_repository->insertOrUpdate($data_insert);
    }

    private function validateFormData($product_form_data)
    {
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