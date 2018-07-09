<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Customer;

class CustomerRepository extends BaseRepository
{
    public $model;

    public function __construct()
    {
        $this->model = new Customer();
        parent::__construct($this->model);
    }
    
    public function findByIds($ids = [])
    {
        return $this->getList($ids);
    }

    //
    public function insertOrUpdate($product_data)
    {
        return [
            'result' => $this->baseInsertOrUpdate($product_data),
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