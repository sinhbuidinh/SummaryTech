<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository extends BaseRepository
{
    public $model;

    public function __construct()
    {
        $this->model = new Article();
        parent::__construct($this->model);
    }

    //
    public function insertOrUpdate($article_data)
    {
        return [
            'result' => $this->baseInsertOrUpdate($article_data, data_get($article_data, 'id')),
            'message' => [
                MESSAGE_TYPE_ERROR   => $this->error_msg,
                MESSAGE_TYPE_SUCCESS => $this->success_msg
            ]
        ];
    }

    public function listAll()
    {
        return $this->getList();
    }
}