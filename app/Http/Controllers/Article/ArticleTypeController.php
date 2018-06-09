<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;

class ArticleTypeController
{
    private $article_type_service;

    public function __construct()
    {
        $this->article_type_service = getService('article_type_service');
    }

    public function index()
    {
        //display all article type
    }

    public function create(Request $request)
    {
        $data = $this->article_type_service->processData($request);

        return view('article.type.create', $data);
    }
}
