<?php

namespace App\Repositories;

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Eloquent\User;

abstract class AbstractRepositoryEloquent
{
    use DispatchesJobs;
    
    protected $user;

    abstract public function model();

    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->model(), $method], $parameters);
    }

    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function datatables($columns = ['*'], $with = [])
    {
        return $this->model()->select($columns)->with($with);
    }
}
