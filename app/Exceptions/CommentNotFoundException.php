<?php

namespace App\Exceptions;

class CommentNotFoundException extends CustomException
{
    public function __construct()
    {
        parent::__construct('Comment not found', 404);
    }
}
