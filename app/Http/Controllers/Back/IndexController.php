<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class IndexController extends BaseController
{
    public function back(Request $request)
    {
        $data = $request->all();
        $data['form_name'] = 'manager_article';

        return view('back.index', $data);
    }
}
