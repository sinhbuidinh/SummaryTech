<?php

namespace App\Services;

class BaseService
{
    public function initDataFrom($form_name, $attribute_accessor, $default_params = [])
    {
        $form_data[$form_name] = [];
        foreach ($attribute_accessor as $key)
        {
            $form_data[$form_name][$key] = $default_params[$key]?? null;
        }

        return $form_data[$form_name];
    }


}