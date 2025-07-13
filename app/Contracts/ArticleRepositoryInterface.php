<?php

namespace App\Contracts;

use App\Dto\ArticleDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\CursorPaginator;

interface ArticleRepositoryInterface
{
    public const ARTICLES_PER_PAGE = 5;

    public function findAllPaginated(): CursorPaginator;

    public function findById(int $id): Model|Builder|null;

    public function create(ArticleDTO $articleDTO): Model;

    public function update(int $id, ArticleDTO $articleDTO): bool;

    public function delete(int $id): void;

    public function getCountsByCategoryId(int $categoryId): int;
}
