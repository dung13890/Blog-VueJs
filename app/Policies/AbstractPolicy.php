<?php

namespace App\Policies;

use App\Eloquent\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isA('system')) {
            return true;
        }
    }

    public function isAdmin($user, $ability)
    {
        if ($user->isA('admin')) {
            return true;
        }
    }

    public function checkAbility(User $user, $method, Model $ability)
    {
        $stringAbility = strtolower(class_basename($ability));

        return $user->can($stringAbility . '-' . $method);
    }
}
