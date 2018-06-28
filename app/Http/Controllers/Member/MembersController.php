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
}
