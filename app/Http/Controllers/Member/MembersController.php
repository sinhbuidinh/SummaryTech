<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class MembersController extends BaseController
{
    private $member_service;

    public function __construct()
    {
        parent::__construct();
        $this->member_service = getService('member_service');
    }

    public function index()
    {
        $data = $this->member_service->listMember();

        return view('member.show', $data);
    }

    public function create(Request $request)
    {
        $assign_data = $this->member_service->processData($request);

        if ( isset($assign_data['result_insert'])
            && $assign_data['result_insert'] == true
        ) {
            return redirect(route('member_list'));
        }

        return view('member.create', $assign_data);
    }

    public function edit(Request $request)
    {
        $request_data = $request->all();
        $member_id = old('member_id', $request_data['member_id']?? null);

        if (empty($member_id)) {
            throw new Exception('Invalid input');
        }

        //get data info loading
        $assign_data = $this->member_service->processData($request);

        return view('member.create', $assign_data);
    }
    
    public function delete(Request $request)
    {
        $request_data = $request->all();
        $member_id = old('member_id', $request_data['member_id']?? null);

        if (empty($member_id)) {
            throw new Exception('Invalid input');
        }

        //get data info loading
        $assign_data = $this->member_service->deleteMember($member_id);

        if ($assign_data == true) {
            return redirect(route('member_list'));
        }

        return view('member.create', $assign_data);
    }
}
