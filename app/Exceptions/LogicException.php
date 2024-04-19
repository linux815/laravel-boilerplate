<?php

namespace App\Exceptions;

class LogicException extends CustomException
{
    public function __construct()
    {
        parent::__construct('Something went wrong', 500);
    }
}
