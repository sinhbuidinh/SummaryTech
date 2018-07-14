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
