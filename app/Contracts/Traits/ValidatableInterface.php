<?php

namespace App\Contracts\Traits;

use App\Contracts\Repositories\AbstractRepository;

interface ValidatableInterface extends AbstractRepository
{
    public function validation($action, $item = null);

    public function rulize(array $rules, $object);
}
