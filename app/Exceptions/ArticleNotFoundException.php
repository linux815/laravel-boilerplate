<?php

namespace App\Exceptions;

class ArticleNotFoundException extends CustomException
{
    public function __construct()
    {
        parent::__construct('Article not found', 404);
    }
}
