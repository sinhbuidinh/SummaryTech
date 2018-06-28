<?php
namespace App\Services;

use App\Services\BaseService;
use App\Repositories\MemberRepository;

class MemberService extends BaseService
{
    private $member_repository;

    public function __construct()
    {
        $this->attr_accessor = [
            'name',
            'group_type',
            'address',
            'telephone',
        ];

        $this->default_params = [
            'name' => '',
            'address' => '',
            'telephone' => '',
            'group_type' => 0,
        ];

        $this->form_name = 'member_form';

        $this->member_repository = new MemberRepository();
    }

    public function listMember()
    {
        $data['list'] = $this->member_repository->listAll();
        $data['member_group_list'] = $this->getMemberGroupList();

        return $data;
    }

    public function processData($request)
    {
        $request_data = $request->all();

        $this->initVariable($this->form_name, $this->attr_accessor, $this->default_params);
        $data[$this->form_name] = $this->initFormData();

        $last_data = array_merge($data, $request_data);
        $last_data['form_name'] = $this->form_name;

        if (!empty($last_data[$this->form_name])
            && $request->isMethod('post')
        ) {
            //insert data
            //check form data & insert
            $form_data = $last_data[$this->form_name];
            $result_validate = $this->validateFormData($form_data);

            if (!empty($result_validate['message'])) {
                $last_data['message'] = $result_validate['message'];
            }

            if ($result_validate['result'] == true) {
                $result_insert = $this->insertMember($form_data);
                $last_data['message']       = $result_insert['message'];
                $last_data['result_insert'] = $result_insert['result'];
            }
        }

        $last_data['member_group_list'] = $this->getMemberGroupList();

        return $last_data;
    }

    private function insertMember($member_form_data)
    {
        //array only attr_accessor
        $data_insert = array_only($member_form_data, $this->attr_accessor);

        return $this->member_repository->insertOrUpdate($data_insert);
    }

    private function validateFormData($member_form_data)
    {
        $result = [
            'result'  => true,
            'message' => []
        ];

        if (empty($member_form_data['name'])) {
            $result['result'] = false;
            $result['message'][MESSAGE_TYPE_ERROR][$this->form_name.'_name'] = 'Nhập tên nhân viên';
        }

        return $result;
    }

    private function getMemberGroupList()
    {
        $key = CONFIG_ARR_BY_CODE;
        $val = CONFIG_ARR_BY_NAME;

        $member_group = getKubunCustom('division.member', 'member_group', $key, $val);

        return $member_group;
    }
}
