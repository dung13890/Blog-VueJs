<?php

namespace App\Contracts\Services;

interface MediaInterface
{
    public function getImageResponse($path, $params);
}
