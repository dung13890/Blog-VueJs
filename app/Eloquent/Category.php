<?php

namespace App\Eloquent;

class Category extends Abstracts\Sluggable
{
    protected $fillable = [
        'name', 'parent_id', 'type', 'description', 'locked'
    ];
}
