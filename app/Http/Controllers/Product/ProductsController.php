<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ProductsController extends BaseController
{
    private $product_service;
    private $product_type_service;

    public function __construct()
    {
        parent::__construct();
        $this->product_service      = getService('product_service');
        $this->product_type_service = getService('product_type_service');
    }

    public function index(Request $request)
    {
        $data = $this->product_service->listProduct();
        $data['request'] = $request->all();

        //display all product
        return view('product.show', $data);
    }

    public function create(Request $request)
    {
        $data = $this->product_service->processData($request);

        return view('product.create', $data);
    }

    public function createType(Request $request)
    {
        $data = $this->product_type_service->processData($request);

        return view('product.type.create', $data);
    }
}