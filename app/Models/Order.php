<?php

namespace App\Models;

use App\Models\BaseModel;

class Order extends BaseModel
{
    public function orderProduct()
    {
        return $this->hasMany('App\Models\OrderProduct');
    }
    
    public function customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }
    
    public function getDebtLimitAttribute() 
    {
        //is ouput bill
        $is_output_bill = $this->output_bill;

        //=1 => calculate by date_export_bill, else cal by date_export
        $date_calculate = $this->date_export;
        if ($is_output_bill == 1) {
            $date_calculate = $this->date_export_bill;
        }

        //date debt
        $date_debt_no = $this->customer->debt;

        //call from date_export_bill
        if (empty($date_calculate)
            || $date_calculate == DATE_FORMAT_YMD_EMPTY
        ) {
            return $date_debt_no;
        }

        //parse
        $date_export_bill = dateParse($date_calculate);

        //limit date
        $limit_date = $date_export_bill->addDays($date_debt_no);

        //today
        $now_date = dateToday();

        //compare limit & now => 
        $date_out_debt = dateCalulateDays($now_date, $limit_date);
        return $limit_date->format(DATE_FORMAT_YMD_SUB).'<br/>('.$date_out_debt.')';
    }

    public function scopeWithName($query, $name)
    {
        return $query->whereHas('customer', function ($query) use ($name) {
            $query->where('company_name', 'like', '%'.$name.'%');
        });
    }

    public function scopeWithOrderCode($query, $order_code)
    {
        return $query->where('order_code', '=', $order_code);
    }

    public function scopeWithDate($query, $date)
    {
        $from = dateStr($date, TRUE, DATE_FORMAT_YMD_SUB.' 00:00:00');
        $to   = dateStr($date, TRUE, DATE_FORMAT_YMD_SUB.' 23:59:59');

        return $query->where(function($query) use ($from, $to) {
                        return $query->where('date_create', '>=', $from)
                                     ->where('date_create', '<=', $to);
                    })
                     ->orWhere(function($query) use ($from, $to) {
                        return $query->where('date_export', '>=', $from)
                                     ->where('date_export', '<=', $to);
                    });
    }
}
