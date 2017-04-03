<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepository;
use App\Traits\ValidatableTrait;
use App\Eloquent\User;

class UserRepositoryEloquent extends AbstractRepositoryEloquent implements UserRepository
{
    use ValidatableTrait;

    protected $rules = [
        'store' => [
            'name' => "required|min:4|max:255",
            'username' => "required|alpha_dash|min:4|max:255|unique:users",
            'email' => "required|email|max:255|unique:users",
            'password' => 'required|alpha_dash|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
            'role_ids' => "required",
            'locked' => 'sometimes|boolean',
            'image'=> 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
        ],
        'update' => [
            'name' => "required|min:4|max:255",
            'username' => "required|alpha_dash|min:4|max:255|unique:users,username,{id}",
            'email' => "required|email|max:255|unique:users,email,{id}",
            'password' => 'confirmed|alpha_dash|min:6',
            'password_confirmation' => 'min:6',
            'role_ids' => "required",
            'locked' => 'sometimes|boolean',
            'image'=> 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
        ],
    ];
    
    public function model()
    {
        return new User;
    }
}
