<?php

namespace App\Domain\Article\Contracts;

use App\Domain\Article\ArticleDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\CursorPaginator;

interface ArticleRepositoryInterface
{
    public const ARTICLES_PER_PAGE = 5;

    public function findAllPaginated(): CursorPaginator;

    public function findById(int $id): ?Model;

    public function create(ArticleDTO $articleDTO): Model;

    public function update(int $id, ArticleDTO $articleDTO): Model;

    public function delete(int $id): bool;

    public function getCountsByCategoryId(int $categoryId): int;
}
