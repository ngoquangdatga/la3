<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'original_price', 'promotion_price', 'new_product', 'quantity', 'categories_id', 'images1','images2', 'images3','images_represent', 'updated_at', 'created_at'];
    protected $table = 'products';

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function bill_detail(){
        return $this->hasMany('App\Bill_Detail');
    }

    public function cart(){
        return $this->hasOne('App\Cart');
    }
}
