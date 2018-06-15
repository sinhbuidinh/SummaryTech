<?php

namespace App\Services;

use App\Repositories\ArticleTypeRepository;

use Exception;
use Illuminate\Support\Facades\DB;

class ArticleTypeService
{
    private $article_type_repository;

    public function __construct()
    {
        $this->article_type_repository = new ArticleTypeRepository();
    }

    public function getArticleTypeList()
    {
        $data['list'] = $this->article_type_repository->listAll();

        return $data;
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

        $new_data = $data;
        try {
            DB::beginTransaction();
            if ($data['validate_result']['result'] === true) {
                $new_data = $this->insUpdArticleType($data);
            }

            //just get message success
            if (isset($new_data['result_process'])) {
                $message = $new_data['result_process']['message'];
                $new_data['message'][MESSAGE_TYPE_SUCCESS] = array_first(array_only($message, MESSAGE_TYPE_SUCCESS));
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            //unset data
            if (isset($new_data['message'])) {
                unset($new_data['message']);
            }

            //message process
            $message = $new_data['result_process']['message'];
            $error_msg = array_first(array_only($message, MESSAGE_TYPE_ERROR));

            $new_data['result_process']['result'] = false;

            if (empty($error_msg)) {
                $new_data['result_process']['message'] = [
                    MESSAGE_TYPE_ERROR => [
                        0 => $e->getMessage()
                    ]
                ];
            } else {
                $new_data['result_process']['message'] = $error_msg;
            }
        }

        return $new_data;
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

        return $data;
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
