<?php

namespace App\Domain\Category\Contracts;

use App\Domain\Category\CategoryDTO;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface CategoryServiceInterface
{
    public function getPaginated(): CursorPaginator;

    public function get(int $id): Builder|Model;

    public function store(CategoryDTO $categoryDTO): void;

    public function update(int $id, CategoryDTO $categoryDTO): void;

    public function delete(int $id): void;

    public function canDelete(int $id): bool;
}
