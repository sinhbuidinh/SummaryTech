<?php

namespace App\Services;

use App\Repositories\ArticleRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class ArticleService extends BaseService
{
    public function __construct() {
        $this->article_repository = new ArticleRepository();
    }
    
    public function getArticleList()
    {
        return $this->article_repository->listAll();
    }
    
    public function createOrUpdate($form_data)
    {
        //check insert or update
//        dd($form_data);
        $process = [];
        $validate_result = $this->validateArticle($form_data);
        try {
            DB::beginTransaction();
            if ($validate_result['result'] === false) {
                throw new Exception('Validate error');
            }
            $data_process = data_get($validate_result, 'data');
            $process = $this->article_repository->insertOrUpdate($data_process);

            //just get message success
            if (!blank($process)) {
                $process['message'][MESSAGE_TYPE_SUCCESS] = array_first(
                    array_only(
                        data_get($process, 'message'), 
                        MESSAGE_TYPE_SUCCESS
                    )
                );
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            $process['result'] = false;
            //message process
            $msg = data_get($validate_result, 'message');
            if (!empty($msg)
                && is_array($msg)
            ) {
                $error_msg = array_first(array_only($msg, [MESSAGE_TYPE_ERROR]));
                $process['message'] = $error_msg;
                if (empty($error_msg)) {
                    $process['message'] = [
                        MESSAGE_TYPE_ERROR => [
                            0 => $e->getMessage()
                        ]
                    ];
                }
            }
        }
        dd($process);
        return $process;
    }
    
    private function validateArticle($article_data)
    {
        $validate = [
            'result'  => true,
            'message' => [],
            'data' => []
        ];

        if (empty(data_get($article_data, 'title'))) {
            $validate['result']  = false;
            $validate['message'][MESSAGE_TYPE_ERROR][] = 'Not allow empty title';
        }

        $validate['data'] = array_only($article_data, [
            'title',
            'column_type',
            'content',
            'content_left',
            'content_right'
        ]);

        return $validate;
    }
}
