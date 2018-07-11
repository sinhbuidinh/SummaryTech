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
        $order_list['orders'] = $this->order_service->getOrderList();
        $request_data = $request->all();

        $assign_data = array_merge($order_list, $request_data);

        $have_vat = $this->order_service->loadListVat();
        $assign_data['vat_define'] = $have_vat;

        return view('order.show', $assign_data);
    }
}
