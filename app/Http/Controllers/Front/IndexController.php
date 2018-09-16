<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class IndexController extends BaseController
{
    public function front(Request $request)
    {
        dd(__FILE__, __LINE__, $request->all());
    }
}
