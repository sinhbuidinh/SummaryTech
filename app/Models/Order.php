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
}
