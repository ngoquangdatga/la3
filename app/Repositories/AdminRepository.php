<?php

namespace App\Repositories;

class AdminRepository extends EloquentRepository
{

    public function getModel()
    {
        return \App\Admin::class;
    }
}
