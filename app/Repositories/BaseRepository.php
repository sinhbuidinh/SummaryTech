<?php

namespace App\Repositories;

use Exception;

class BaseRepository
{
    protected $model;

    protected $error_msg;

    protected $success_msg;

    public function __construct($model_obj)
    {
        $this->model = $model_obj;
    }

    protected function getList($ids = [], $key_find = 'id')
    {
        if (empty($ids)) {
            return $this->model->get();
        }

        return $this->model->whereIn($key_find, $ids)->get();
    }

    protected function baseInsertOrUpdate($form_data, $primary_id = null)
    {
        try {
            if (!empty($primary_id)) {
                $old_data = $this->model->find($primary_id);

                //update
                $old_data->name = $form_data['name'];
                $old_data->lang_id = $form_data['lang_id'];

                $old_data->save();
                $this->success_msg[] = 'Update success';
            } else {
                $new_data = $this->model;

                //insert data
                $new_data->name = $form_data['name'];
                $new_data->lang_id = $form_data['lang_id'];

                $new_data->save();
                $this->success_msg[] = 'Insert success';
            }

            return true;
        } catch (Exception $e) {
            $this->error_msg[] = $e->getMessage();

            return false;
        }
    }
}