<?php

namespace App\Models;

use App\Models\BaseModel;

class OrderProduct extends BaseModel
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}