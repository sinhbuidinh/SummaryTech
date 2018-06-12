<?php

namespace App\Services;

use App\Repositories\ArticleTypeRepository;

class ArticleTypeService
{
    private $article_type_repository;

    public function __construct()
    {
        $this->article_type_repository = new ArticleTypeRepository();
    }

    //
    public function processData($request)
    {
        //get form data
        $data_form = $request->all();

        //create data
        $data = [
            'article_type_form' => [
                'id' => null,
                'name' => '',
                'lang_id' => 0
            ]
        ];

        if (!empty($data_form)) {
            $data = array_merge($data, $data_form);
        }

        $data['validate_result'] = $this->validateArticleTypeForm($request);

        if ($data['validate_result']['result'] === true) {
            $this->insUpdArticleType($data);
        }

        return $data;
    }

    private function insUpdArticleType($data)
    {
        //check ins or update
        if (!isset($data['article_type_form']['id'])
            || $data['article_type_form']['id'] === null
        ) {
            //insert
            $data_form_last = $data['article_type_form'];
        } else {
            $data_form_last = $data['article_type_form'];
        }
        $data['result_process'] = $this->article_type_repository->insertOrUpdate($data_form_last, $data_form_last['id']?? null);
    }

    private function validateArticleTypeForm($request)
    {
        $result = [
            'result' => true,
            'message' => null
        ];

        $request_data = $request->all();

        $begin_str_form = 'article_type_form';
        $form_data = $request_data[$begin_str_form]?? [];

        if (empty($form_data)) {
            $result['result'] = false;
            $result['message'][MESSAGE_TYPE_ERROR][] = 'Not have data';
            return $result;
        }

        if (empty($form_data['name'])) {
            $result['result'] = false;
            $result['message'][MESSAGE_TYPE_ERROR][$begin_str_form.'_name'] = 'Not have name';
        }

        if (empty($form_data['lang_id'])) {
            $result['result'] = false;
            $result['message'][MESSAGE_TYPE_ERROR][$begin_str_form.'_lang_id'] = 'Please choose lang';
        }

        return $result;
    }
}
