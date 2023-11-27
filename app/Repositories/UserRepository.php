<?php

namespace App\Repositories;

class UserRepository extends EloquentRepository
{

    public function getModel()
    {
        return \App\User::class;
    }
}
