<?php

namespace App\Repositories;

class BaseRepository
{
    protected $model;

    public function __construct($model_name)
    {
        $this->model = $model_name;
    }

    protected function getList($ids = [], $key_find = 'id')
    {
        if (empty($ids)) {
            return $this->model->get();
        }

        return $this->model->whereIn($key_find, $ids)->get();
    }
}