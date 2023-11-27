<?php

namespace App\Repositories;

class BlogRepository extends EloquentRepository
{
    public function getModel()
    {
        return \App\Blog::class;
    }
}
