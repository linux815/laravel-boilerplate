<?php

namespace App\Domain\Category\Contracts;

use App\Domain\Category\CategoryDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\CursorPaginator;

interface CategoryRepositoryInterface
{
    public const CATEGORY_PER_PAGE = 5;

    public function findAllPaginated(): CursorPaginator;

    public function findById(int $id): Model|Builder|null;

    public function create(CategoryDTO $categoryDTO): Model;

    public function update(int $id, CategoryDTO $categoryDTO): bool;

    public function delete(int $id): void;
}
