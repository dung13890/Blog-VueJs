<?php

namespace App\Traits;

trait ImagableTrait
{
    public function getImageAttribute($value)
    {
        return $value ? app()['glide.builder']->getUrl($value) : null;
    }

    public function getImageThumbnailAttribute($value)
    {
        return app()['glide.builder']->getUrl($this->image, ['p' => 'thumbnail']);
    }

    public function getImageSmallAttribute($value)
    {
        return app()['glide.builder']->getUrl($this->image, ['p' => 'small']);
    }

    public function getImageMediumAttribute($value)
    {
        return app()['glide.builder']->getUrl($this->image, ['p' => 'medium']);
    }

    public function getImageLargeAttribute($value)
    {
        return app()['glide.builder']->getUrl($this->image, ['p' => 'large']);
    }
}
