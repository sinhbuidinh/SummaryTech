<?php

namespace App\Services;

class BaseService
{
    public $form_name;
    public $attr_accessor;
    public $default_params;

    public function initVariable($form_name, $attribute_accessor, $default_params = [])
    {
        $this->form_name      = $form_name;
        $this->attr_accessor  = $attribute_accessor;
        $this->default_params = $default_params;
    }

    public function initFormData()
    {
        $form_data[$this->form_name] = [];
        foreach ($this->attr_accessor as $key)
        {
            $form_data[$this->form_name][$key] = $this->default_params[$key]?? null;
        }

        return $form_data[$this->form_name];
    }
}