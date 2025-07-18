<?php

namespace App\Domain\Article\Contracts;

use App\Domain\Article\ArticleDTO;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Model;

interface ArticleServiceInterface
{
    public function getPaginated(): CursorPaginator;

    public function get(int $id): ?Model;

    public function store(ArticleDTO $articleDTO): Model;

    public function update(int $id, ArticleDTO $articleDTO): Model;

    public function delete(int $id): bool;

    public function getCountsByCategoryId(int $categoryId): int;
}
