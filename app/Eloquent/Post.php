<?php

namespace App\Eloquent;

class Post extends Abstracts\Sluggable
{
    protected $fillable = [
        'name', 'image', 'content', 'description', 'featured', 'locked', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
