<?php

namespace App\Contracts\Repositories;

use App\Eloquent\User;

interface UserRepository extends AbstractRepository
{
    public function remove(User $user);
}
