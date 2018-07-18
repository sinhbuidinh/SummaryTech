<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class CustomersController extends BaseController
{
    private $customer_service;

    public function __construct()
    {
        parent::__construct();
        $this->customer_service = getService('customer_service');
    }

    public function index()
    {
        $data = $this->customer_service->listCustomer();

        return view('customer.show', $data);
    }

    public function create(Request $request)
    {
        $assign_data = $this->customer_service->processData($request);

        if ( isset($assign_data['result_insert'])
            && $assign_data['result_insert'] == true
        ) {
            return redirect(route('customer_list'));
        }

        return view('customer.create', $assign_data);
    }
    
    public function edit(Request $request)
    {
        $request_data = $request->all();
        $customer_id = old('customer_id', $request_data['customer_id']?? null);

        if (empty($customer_id)) {
            throw new Exception('Invalid input');
        }

        $assign_data = $this->customer_service->processData($request);

        return view('customer.create', $assign_data);
    }
}
