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

    public function create(Request $request)
    {
        $assign_data = $this->customer_service->processData($request);

        return view('customer.create', $assign_data);
    }
}
