<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;

class ArticleTypeController
{
    public function index()
    {
        //display all article type
    }

    public function create(Request $request)
    {
        //get form data
        $data_form = $request->all();

        //create data
        $data = [
            'article_type_form' => [
                'name' => '',
                'lang_id' => 0
            ]
        ];

        if (!empty($data_form)) {
            $data = array_merge($data, $data_form);
        }

        return view('article.type.create', $data);
    }

}
