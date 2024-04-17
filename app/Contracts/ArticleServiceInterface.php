<?php

namespace App\Contracts;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface ArticleServiceInterface
{
    public function getPaginated(): CursorPaginator;

    public function get(int $id): Builder | Model;
}
