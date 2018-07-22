<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;

class ProductsController extends BaseController
{
    private $product_service;
    private $product_type_service;
    private $wood_type_service;

    public function __construct()
    {
        parent::__construct();
        $this->product_service      = getService('product_service');
        $this->product_type_service = getService('product_type_service');
        $this->wood_type_service    = getService('wood_type_service');
    }

    public function edit(Request $request)
    {
        $request_data = $request->all();
        $product_id = old('product_form.id', old('product_id', $request_data['product_id']?? null));

        if (empty($product_id)) {
            throw new Exception('Invalid input');
        }

        $assign_data = $this->product_service->processData($request);

        return view('product.create', $assign_data);
    }
    
    public function delete(Request $request)
    {
        $request_data = $request->all();
        $product_id = old('product_form.id', old('product_id', $request_data['product_id']?? null));

        if (empty($product_id)) {
            throw new Exception('Invalid input');
        }

        $assign_data = $this->product_service->deleteProduct($product_id);
        if ($assign_data == true) {
            return redirect(route('product_list'));
        } else {
            $assign_data = $this->product_service->processData($request);
        }

        return view('product.create', $assign_data);
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

        if ( isset($data['result_insert'])
            && $data['result_insert'] == true
        ) {
            return redirect(route('product_list'));
        }

        return view('product.create', $data);
    }

    public function createType(Request $request)
    {
        $data = $this->product_type_service->processData($request);
        if ( isset($data['result_insert'])
            && $data['result_insert'] == true
        ) {
            return redirect(route('product_type_list'));
        }

        return view('product.type.create', $data);
    }
    
    public function deleteType(Request $request)
    {
        $request_data = $request->all();
        $product_type_id = old('product_type_form.id', old('product_type_id', $request_data['product_type_id']?? null));

        if (empty($product_type_id)) {
            throw new Exception('Invalid input');
        }

        $assign_data = $this->product_service->deleteProductType($product_type_id);
        if ($assign_data == true) {
            return redirect(route('product_type_list'));
        } else {
            $assign_data = $this->product_type_service->processData($request);
        }

        return view('product.type.create', $assign_data);
    }
    
    public function productTypeList(Request $request)
    {
        $data['list'] = $this->product_type_service->getListProductType();
        $data['request'] = $request->all();

        //display all product
        return view('product.type.show', $data);
    }
    
    public function productTypeEdit(Request $request)
    {
        $request_data = $request->all();
        $product_type_id = old('product_type_form.id', old('product_type_id', $request_data['product_type_id']?? null));

        if (empty($product_type_id)) {
            throw new Exception('Invalid input');
        }

        $data = $this->product_type_service->processData($request);

        return view('product.type.create', $data);
    }
    
    public function woodTypeCreate(Request $request)
    {
        $data = $this->wood_type_service->processData($request);
        if ( isset($data['result_insert'])
            && $data['result_insert'] == true
        ) {
            return redirect(route('product_wood_type_list'));
        }

        return view('product.wood.create', $data);
    }
    
    public function woodTypeList()
    {
        $data['list'] = $this->wood_type_service->getListWoodType();

        //display all product
        return view('product.wood.show', $data);
    }
    
    public function woodTypeEdit(Request $request)
    {
        $request_data = $request->all();
        $wood_type_id = old('wood_type_form.id', old('wood_type_id', $request_data['wood_type_id']?? null));

        if (empty($wood_type_id)) {
            throw new Exception('Invalid input');
        }

        $data = $this->wood_type_service->processData($request);

        return view('product.wood.create', $data);
    }
    
    public function woodTypeDelete(Request $request)
    {
        $request_data = $request->all();
        $wood_type_id = old('wood_type_form.id', old('wood_type_id', $request_data['wood_type_id']?? null));

        if (empty($wood_type_id)) {
            throw new Exception('Invalid input');
        }

        $assign_data = $this->wood_type_service->deleteProductWoodType($wood_type_id);
        if ($assign_data == true) {
            return redirect(route('product_wood_type_list'));
        } else {
            $assign_data = $this->wood_type_service->processData($request);
        }

        return view('product.wood.create', $assign_data);
    }
}