<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\ArticleType;

class ArticleTypeRepository extends BaseRepository
{
    protected $model;

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
                'error' => $this->error,
                'success' => $this->success
            ]
        ];
    }
}