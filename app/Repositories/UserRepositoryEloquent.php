<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepository;

class UserRepositoryEloquent extends AbstractRepositoryEloquent implements UserRepository
{
    public function model()
    {
        return new \App\Eloquent\User;
    }
}
