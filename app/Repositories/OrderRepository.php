<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository
{
    public $model;

    public function __construct()
    {
        $this->model = new Order();
        parent::__construct($this->model);
    }

    //
    public function insertOrUpdate($product_data)
    {
        $result = $this->baseInsertOrUpdate($product_data);

        return [
            'insert_id' => $this->last_id,
            'result'    => $result,
            'message'   => [
                MESSAGE_TYPE_ERROR   => $this->error_msg,
                MESSAGE_TYPE_SUCCESS => $this->success_msg
            ]
        ];
    }
    
    public function insert($order_data)
    {
        try {
            $new_data = new Order();

            //insert data
            $this->settingDataByFormKey($order_data, $new_data);

            $new_data->save();
            $this->last_id = $new_data->id?? null;
            $this->success_msg[] = 'Insert success';
            $result = true;
        } catch (Exception $e) {
            $this->error_msg[] = $e->getMessage();
            $result = false;
        }

        return [
            'insert_id' => $this->last_id,
            'result'    => $result,
            'message'   => [
                MESSAGE_TYPE_ERROR   => $this->error_msg,
                MESSAGE_TYPE_SUCCESS => $this->success_msg
            ]
        ];
    }

    public function listAll($ids = [], $order = [], $key_find = 'id')
    {
        return $this->getList($ids, $order, $key_find);
    }
    
    public function searchByRawSql($raw_sql)
    {
        return DB::select(DB::raw($raw_sql));
    }
}