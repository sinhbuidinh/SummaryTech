<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Member;

class MemberRepository extends BaseRepository
{
    public $model;

    public function __construct()
    {
        $this->model = new Member();
        parent::__construct($this->model);
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

    public function listAll($id = [])
    {
        return $this->getList($id);
    }
    
    public function delete($id)
    {
        $member = $this->model->where('id', '=', $id);
        if (blank($member)) {
            return 0;
        }

        return $member->delete();
    }
}