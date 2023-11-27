<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';

    public function bill_detail(){
        return $this->hasMany('App\BillDetail');
    }

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
}
