<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;

class BaseRepository
{
    protected $model;

    protected $error_msg;

    protected $success_msg;

    protected $last_id;

    public function __construct($model_obj)
    {
        DB::enableQueryLog();
        $this->model = $model_obj;
    }
    
    public function getLogQuery()
    {
        $log_query = DB::getQueryLog();
        return $log_query;
    }
    
    public function getLastQuery()
    {
        $log_query = $this->getLogQuery();
        if (empty($log_query)) {
            return null;
        }
        
        return end($log_query);
    }

    protected function getList($ids = [], $order = [], $key_find = 'id')
    {
        $order_str = 'id DESC';
        if (!empty($order)) {
            $order_str = implode(', ', $order);
        }

        if (empty($ids)) {
            return $this->model
                        ->selectRaw('*')
                        ->orderByRaw($order_str)
                        ->get();
        }

        return $this->model
                    ->whereIn($key_find, $ids)
                    ->orderByRaw($order_str)
                    ->get();
    }

    protected function baseInsertOrUpdate($form_data, $primary_id = null)
    {
        try {
            if (!empty($primary_id) || !empty($form_data['id'])) {
                $id = $primary_id ?? ($form_data['id']?? null);
                $old_data = $this->model->find($id);

                //update
                $this->settingDataByFormKey($form_data, $old_data);

                $old_data->save();
                $this->last_id = $old_data->id?? null;
                $this->success_msg[] = 'Update success';
            } else {
                $new_data = clone $this->model;

                //insert data
                $this->settingDataByFormKey($form_data, $new_data);

                $new_data->save();

                $this->last_id = $new_data->id?? null;
                $this->success_msg[] = 'Insert success';
            }

            return true;
        } catch (Exception $e) {
            $this->error_msg[] = $e->getMessage();

            return false;
        }
    }

    protected function settingDataByFormKey($form_data, &$obj)
    {
        if (!empty($form_data)) {
            foreach ($form_data as $key => $value) {
                $obj->$key = $value;
            }
        }

        return $obj;
    }
}