<?php

namespace App\Services;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrderExportService implements FromView
{
    use Exportable;
    private $data;

    public function view(): View
    {
        $data = [
            'orders'    => $this->data['result_search'],
            'is_search' => $this->data['is_search']
        ];
        $last_data = array_merge($data, $this->data);

        return view('order.info_list', $last_data);
    }

    public function settingData($data)
    {
        $this->data = $data;
    }
}
