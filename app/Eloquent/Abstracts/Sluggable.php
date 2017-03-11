<?php

namespace App\Eloquent\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable as SluggableTrait;

abstract class Sluggable extends Model
{
    use SluggableTrait;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
