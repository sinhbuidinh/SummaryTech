<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ArticleController extends BaseController
{
    private $article_service;
    
    public function __construct() {
        parent::__construct();
        $this->article_service = getService('article_service');
    }
    
    public function create(Request $request)
    {
        $data = $request->all();

        $form_name = 'manager_article';
        $data['form_name'] = $form_name;

        $data['result'] = $this->article_service->createOrUpdate(data_get($data, $form_name));

        return view('back.index', $data);
    }
}
