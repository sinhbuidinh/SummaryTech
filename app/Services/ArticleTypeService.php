<?php

namespace App\Services;

class ArticleTypeService
{
    //
    public function processData($request)
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

        return $data;
    }
}
