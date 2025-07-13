<?php

namespace App\Domain\Category\Contracts;

use App\Domain\Category\CategoryDTO;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Model;

interface CategoryServiceInterface
{
    public function getPaginated(): CursorPaginator;

    public function get(int $id): ?Model;

    public function store(CategoryDTO $categoryDTO): Model;

    public function update(int $id, CategoryDTO $categoryDTO): Model;

    public function delete(int $id): bool;

    public function canDelete(int $id): bool;
}
