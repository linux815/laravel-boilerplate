<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\CursorPaginator;

interface ArticleRepositoryInterface
{
    public const ARTICLES_PER_PAGE = 1;

    public function findAllPaginated(): CursorPaginator;

    public function findById(int $id): Model | Builder | null;
}
