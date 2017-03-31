<?php

namespace App\Contracts\Repositories;

use App\Eloquent\User;
use App\Contracts\Traits\ValidatableInterface;

interface UserRepository extends ValidatableInterface
{
    public function remove(User $user);

    public function store(array $attributes);
}
