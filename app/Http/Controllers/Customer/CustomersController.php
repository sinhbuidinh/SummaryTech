<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class CustomersController extends BaseController
{
    private $customer_service;
    private $member_service;

    public function __construct()
    {
        parent::__construct();
        $this->customer_service = getService('customer_service');
        $this->member_service = getService('member_service');
    }

    public function index()
    {
        $data = $this->customer_service->listCustomer();

        return view('customer.show', $data);
    }

    public function create(Request $request)
    {
        $assign_data = $this->customer_service->processData($request);
        $assign_data['member_list'] = $this->member_service->listMember();

        if ( isset($assign_data['result_insert'])
            && $assign_data['result_insert'] == true
        ) {
            return redirect(route('customer_list'));
        }

        return view('customer.create', $assign_data);
    }
}
