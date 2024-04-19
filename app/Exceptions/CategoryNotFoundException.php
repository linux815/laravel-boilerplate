<?php

namespace App\Exceptions;

class CategoryNotFoundException extends CustomException
{
    public function __construct()
    {
        parent::__construct('Category not found', 404);
    }
}
