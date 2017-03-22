<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepository;
use App\Eloquent\User;

class UserRepositoryEloquent extends AbstractRepositoryEloquent implements UserRepository
{
    public function model()
    {
        return new User;
    }

    public function remove(User $user)
    {
        return $user->delete();
    }
}
