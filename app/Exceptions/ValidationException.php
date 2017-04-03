<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    protected $action;

    protected $item;

    protected $attribute;
    
    protected $message = "You're forbidden";

    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    public function setItem($item)
    {
        $this->item = $item;
        return $this;
    }

    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
        return $this;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function getAttribute()
    {
        return $this->attribute;
    }
}
