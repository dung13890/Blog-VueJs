<?php

namespace App\Contracts\Repositories;

use App\Eloquent\User;

interface AbstractRepository
{
    public function model();

    public function setUser(User $user);
}
