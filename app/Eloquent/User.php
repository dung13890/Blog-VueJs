<?php

namespace App\Eloquent;

use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\ImagableTrait;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndAbilities, ImagableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'locked', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('id', function (Builder $builder) {
            $builder->where('id', '>', 1);
        });
    }

    public function scopeByKeyword($query, $keyword)
    {
        return $query->where('name', 'LIKE', "{$keyword}%")
            ->orWhere('username', 'LIKE', "{$keyword}%")
            ->orWhere('email', 'LIKE', "{$keyword}%");
    }

    public function scopeByRole($query, $role)
    {
        return $query->whereHas('roles', function ($query) use ($role) {
            return $query->where('id', $role);
        });
    }

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
}
