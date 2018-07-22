<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\WoodTypeRepository;
use Exception;

class WoodTypeService extends BaseService
{
    private $wood_type_repository;

    public function __construct()
    {
        $this->attr_accessor = [
            'id',
            'name',
            'short_name',
        ];

        $this->default_params = [
            'name' => '',
        ];

        $this->form_name = 'wood_type_form';

        $this->wood_type_repository = new WoodTypeRepository();
    }
    
    public function getWoodTypeById($id)
    {
        $wood_type_list = $this->wood_type_repository->listAll([$id]);
        $wood_type = $wood_type_list->first();

        return $wood_type;
    }
    
    private function identifyDefaultEdit($wood_type_id)
    {
        //is_edit
        $wood_type_info = $this->getWoodTypeById($wood_type_id);

        if (!empty($wood_type_info)) {
            $this->default_params = $wood_type_info->toArray();
        } else {
            throw new Exception('wood_type_id không hợp lệ!!!');
        }
    }

    public function processData($request)
    {
        $request_data = $request->all();

        $wood_type_id = $request_data['wood_type_id']?? null;
        if (!empty($wood_type_id)) {
            $is_edit = true;
            $this->identifyDefaultEdit($wood_type_id);
        }

        $this->initVariable($this->form_name, $this->attr_accessor, $this->default_params);
        $data[$this->form_name] = $this->initFormData();

        $last_data = array_merge($data, $request_data);
        $last_data['form_name'] = $this->form_name;

        if (!empty($last_data[$this->form_name]) 
            && $request->isMethod('post')
        ) {
            //check form data & insert
            $form_data = $last_data[$this->form_name];
            $result_validate = $this->validateFormData($form_data);

            if (!empty($result_validate['message'])) {
                $last_data['message'] = $result_validate['message'];
            }

            if ($result_validate['result'] == true) {
                $result_insert = $this->insertWoodType($form_data);
                $last_data['message']       = $result_insert['message'];
                $last_data['result_insert'] = $result_insert['result'];
            }
        }

        $last_data['is_edit'] = $is_edit?? false;

        return $last_data;
    }

    public function deleteProductWoodType($wood_type_id)
    {
        $result = $this->wood_type_repository->delete($wood_type_id);
        if ($result > 0) {
            return true;
        }

        return false;
    }

    public function getListWoodType($id = [], $order = [])
    {
        $wood_type = $this->wood_type_repository->listAll($id, $order)->toArray();
        return $wood_type;
    }

    private function insertWoodType($wood_form_data)
    {
        //array only attr_accessor
        $data_insert = array_only($wood_form_data, $this->attr_accessor);

        return $this->wood_type_repository->insertOrUpdate($data_insert);
    }

    private function validateFormData($wood_form_data)
    {
        $result = [
            'result'  => true,
            'message' => []
        ];

        if (empty($wood_form_data['name'])) {
            $result['result'] = false;
            $result['message'][MESSAGE_TYPE_ERROR][$this->form_name.'_name'] = 'Nhập tên loại gỗ ép';
        }

        return $result;
    }
}