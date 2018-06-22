<?php

namespace App\Http\Controllers;

class BaseController
{
    public $data;

    public function __construct()
    {
        if (!empty(session('message'))) {
            $this->data['message'] = session('message');
        }
    }
}
