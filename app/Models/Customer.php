<?php

namespace App\Models;

use App\Models\BaseModel;

class Customer extends BaseModel
{
    public function member()
    {
        return $this->hasOne('App\Models\Member', 'id', 'business_member');
    }
}
