<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class OrdersController extends BaseController
{
    private $order_service;

    public function __construct()
    {
        parent::__construct();
        $this->order_service = getService('order_service');
    }

    public function create(Request $request)
    {
        $assign_data = $this->order_service->processData($request);

        return view('order.create', $assign_data);
    }
    
    public function index(Request $request)
    {
        $order_list = $this->order_service->getOrderList();
        
        return view('order.show', $request->all());
    }
}
