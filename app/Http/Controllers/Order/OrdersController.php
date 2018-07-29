<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;

class OrdersController extends BaseController
{
    private $order_service;
    private $order_export_service;
    private $order_import_service;

    public function __construct()
    {
        parent::__construct();
        $this->order_service = getService('order_service');
        $this->order_export_service = getService('order_export_service');
        $this->order_import_service = getService('order_import_service');
    }

    public function create(Request $request)
    {
        $assign_data = $this->order_service->processData($request);
        if ( isset($assign_data['result_insert'])
            && $assign_data['result_insert'] == true
        ) {
            return redirect(route('order_list'));
        }

        return view('order.create', $assign_data);
    }
    
    public function index(Request $request)
    {
        $assign_data = $this->order_service->getInfoDispList($request);

        return view('order.show', $assign_data);
    }
    
    public function edit(Request $request)
    {
        $request_data = $request->all();
        $order_id = old('order_id', $request_data['order_id']?? null);

        if (empty($order_id)) {
            throw new Exception('Invalid input');
        }

        $assign_data = $this->order_service->processData($request);

        return view('order.create', $assign_data);
    }

    public function delete(Request $request)
    {
        $request_data = $request->all();
        $order_id = old('order_id', $request_data['order_id']?? null);

        if (empty($order_id)) {
            throw new Exception('Invalid input');
        }

        //get data info loading
        $assign_data = $this->order_service->deleteOrder($order_id);

        if ($assign_data == true) {
            return redirect(route('order_list'));
        } else {
            $assign_data = $this->order_service->processData($request);
        }

        return view('customer.create', $assign_data);
    }

    public function owe(Request $request)
    {
        $last_data = $this->order_service->processOweSearch($request);

        //check export or not
        $result = $this->export($last_data);
        if ($result !== true) {
            return $result;
        }

        return view('order.owe', $last_data);
    }

    public function export($data_process)
    {
        if (!isset($data_process['search_by'])
            || !isset($data_process['search_by']['is_export'])
            || $data_process['search_by']['is_export'] != 1
        ) {
            return true;
        }

        //setting data for download
        $this->order_export_service->settingData($data_process);

        //loading data export info
        $export_info = $data_process['export_info'] ?? [];

        //download file with name
        $name_export = $export_info['file_name']?? '';

        if (empty($name_export)) {
            $now_str = dateToday(DATE_FORMAT_YMD);
            $name_export = "export_{$now_str}.xls";
        }

        return $this->order_export_service->download($name_export);
    }

    public function import(Request $request)
    {
        //import
        $data = $this->order_import_service->processImportOrder($request);

        return view('order.import', $data);
    }
}
