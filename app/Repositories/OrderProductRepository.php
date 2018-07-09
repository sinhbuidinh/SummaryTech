<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\OrderProduct;

class OrderProductRepository extends BaseRepository
{
    public $model;

    public function __construct()
    {
        $this->model = new OrderProduct();
        parent::__construct($this->model);
    }

    public function insertOrUpdate($order_product_data)
    {
        return [
            'result' => $this->baseInsertOrUpdate($order_product_data),
            'message' => [
                MESSAGE_TYPE_ERROR   => $this->error_msg,
                MESSAGE_TYPE_SUCCESS => $this->success_msg
            ]
        ];
    }
}