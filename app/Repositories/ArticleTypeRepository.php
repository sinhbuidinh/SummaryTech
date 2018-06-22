<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\ArticleType;

class ArticleTypeRepository extends BaseRepository
{
    public $model;

    public function __construct()
    {
        $this->model = new ArticleType();
        parent::__construct($this->model);
    }

    //
    public function insertOrUpdate($article_type_data)
    {
        return [
            'result' => $this->baseInsertOrUpdate($article_type_data),
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