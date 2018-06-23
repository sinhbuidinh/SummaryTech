<?php

namespace App\Services;

use App\Services\BaseService;

class ProductService extends BaseService
{
    public function __construct()
    {
        $this->attr_accessor = [
            'deck_type',
            'owner',
            'color',
            'length',
            'width',
            'height'
        ];

        $this->default_params = [
            'deck_type' => 0,
            'owner' => 0,
            'color' => 0,
            'length' => 0,
            'width' => 0,
            'height' => 0
        ];

        $this->form_name = 'product_form';
    }

    public function processData($request)
    {
        $request_data = $request->all();

        $this->initVariable($this->form_name, $this->attr_accessor, $this->default_params);
        $data[$this->form_name] = $this->initFormData();

        $last_data = array_merge($data, $request_data);

        return $last_data;
    }
}