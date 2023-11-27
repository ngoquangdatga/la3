<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'images1', 'updated_at', 'created_at'];
    protected $table = 'categories';

    //1 loai co nhieu san pham dung hasOne
    public function product(){
        return $this->hasOne('App\Product');
    }
}
