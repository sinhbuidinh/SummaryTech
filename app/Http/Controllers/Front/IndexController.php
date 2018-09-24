<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class IndexController extends BaseController
{
    private $article_service;

    public function __construct() 
    {
        parent::__construct();
        $this->article_service = getService('article_service');
    }

    public function front(Request $request)
    {
        $data = $request->all();
        $data['articles'] = $this->article_service->getArticleList();

        return view('front.index', $data);
    }
}
