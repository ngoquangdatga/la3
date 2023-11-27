<?php

namespace App\Repositories;

class CategoryRepository extends EloquentRepository
{

    public function getModel()
    {
        return \App\Category::class;
    }
}
