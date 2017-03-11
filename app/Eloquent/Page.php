<?php

namespace App\Eloquent;

class Page extends Abstracts\Sluggable
{
    protected $fillable = [
        'name', 'description', 'content', 'featured', 'locked'
    ];
}
