<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = ['id', 'user_id', 'product_id', 'size', 'color', 'quantity'];

    public function product(){
        return $this->belongsTo('App\Product');
    }
}
