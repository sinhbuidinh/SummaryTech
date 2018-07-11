<?php

namespace App\Http\Controllers;

class BaseController
{
    public $data;

    public function __construct()
    {
        $this->data = [];
        if (!empty(session('message'))) {
            $this->data['message'] = session('message');
        }
        date_default_timezone_set(DEFAULT_TIMEZONE);
    }
}
