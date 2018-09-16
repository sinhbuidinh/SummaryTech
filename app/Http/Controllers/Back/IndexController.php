<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class IndexController extends BaseController
{
    public function back(Request $request)
    {
        dd(__FILE__, __LINE__, $request->all());
    }
}
