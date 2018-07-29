<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class OrderImportService
{
    private $format = [
        'date_create' => 'A',
        'debt' => 'D',
        'date_export' => 'E',
        'member_id' => 'F',
        'customer_id' => 'G',
        'product_name' => 'I',
        'product_code' => 'J',
        'number' => 'L',
        'real_number' => 'M',
        'unit' => 'N',
        'total' => 'O',
        'is_vat' => 'P',
        'transfer_fee' => 'Q',
        'address_delivery' => 'R',
        'contact_info' => 'S',
        'note' => 'T',
    ];
    
    private $date_arr = [
        'date_create',
        'date_export',
    ];
    
    private $number_arr = [
        'debt',
        'member_id',
        'customer_id',
        'number',
        'real_number',
        'unit',
        'total',
        'transfer_fee',
    ];

    public function __construct()
    {
    }

    public function processImportOrder($request)
    {
        $request_data = $request->all();

        if ($request->file('file_import')
            && $request->file('file_import')->isValid()
        ) {
            ini_set('memory_limit', -1);
            
            $file_info = $request->file('file_import');
            $file_name = $file_info->path();

            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(TRUE);
            $spreadsheet = $reader->load($file_name);

            $this->formatDataFromXls($spreadsheet);
            return;

            dd($data_formated);
        }

        return $request_data;
    }

    private function formatDataFromXls($spreadsheet)
    {
        $worksheet = $spreadsheet->getActiveSheet();
        // Get the highest row and column numbers referenced in the worksheet
        $highestRow         = $worksheet->getHighestRow(); // e.g. 10
        $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
        $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn); // e.g. 5

        $sheet_data = [];
        for ($row = 1; $row <= $highestRow; $row++) {
            $cell_char = 'A';
            for ($col = 1; $col <= $highestColumnIndex; $col++) {
                $cell_info = $worksheet->getCellByColumnAndRow($col, $row);

                if ($row != 1) {
                    list($key, $value_insert) = $this->identifyAndAddData($cell_info, $cell_char);
                    !empty($key) ? $sheet_data[$row][$key] = $value_insert : '';
                }
                $cell_char++;
            }
        }

        $result_insert = $this->formatData($sheet_data);
        dd($result_insert);
    }
    
    private function formatData($sheet_data)
    {
        dd($sheet_data);
        foreach ($sheet_data as $row => $data) {
            
        }
    }
    
    private function identifyAndAddData($cell_info, $current_cell_char)
    {
        $result = [];

        $current_cell = $cell_info->getCoordinate() ?? null;
        if ($current_cell === null
            || strpos($current_cell, $current_cell_char) === false
        ) {
            throw new Exception('Invalid in '.__FILE__.' AND line: '.__LINE__. " {$current_cell}, {$current_cell_char}");
        }

        $key = array_search($current_cell_char, $this->format);
        if ($key !== false) {
            $cell_info = $this->formatCellInfo($key, $cell_info);
//            $result = $cell_info->getValue();
            $result = $cell_info->getFormattedValue();

//            if (in_array($key, $this->date_arr)) {
//                dd($cell_info->getFormattedValue(), $val_formated);
//            }
        }
//        else {
//            dd($current_cell_char, $this->format);
//        }

        return [$key, $result];
    }

    private function formatCellInfo($key, $cell_info)
    {
        if (in_array($key, $this->date_arr)) {
            $format = NumberFormat::FORMAT_DATE_YYYYMMDD2;
        } elseif (in_array($key, $this->number_arr)) {
            $format = NumberFormat::FORMAT_NUMBER;
        } else {
            $format = NumberFormat::FORMAT_TEXT;
        }

        $cell_info->getStyle()
                ->getNumberFormat()
                ->setFormatCode($format);

        return $cell_info;
    }
}
