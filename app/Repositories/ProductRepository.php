<?php

namespace App\Repositories;

class ProductRepository extends EloquentRepository
{

    public function getModel()
    {
        return \App\Product::class;
    }
}
