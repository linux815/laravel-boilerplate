<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    protected $customCode;

    public function __construct($message, $customCode)
    {
        parent::__construct($message, 422);

        $this->customCode = $customCode;
    }

    public function getCustomCode()
    {
        return $this->customCode;
    }
}
