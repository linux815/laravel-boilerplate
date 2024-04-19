<?php

namespace App\Repository;

use App\Contracts\CategoryRepositoryInterface;
use App\Dto\CategoryDTO;
use App\Exceptions\CategoryNotFoundException;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\CursorPaginator;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(private readonly Category $category)
    {
    }

    public function findAllPaginated(): CursorPaginator
    {
        return $this->category->newQuery()
            ->filters()
            ->latest()
            ->cursorPaginate(self::CATEGORY_PER_PAGE);
    }

    public function findById(int $id): Builder | Model | null
    {
        return $this->category->newQuery()->find($id);
    }

    public function create(CategoryDTO $categoryDTO): Model
    {
        return $this->category->newQuery()->create($categoryDTO->jsonSerialize());
    }

    public function update(int $id, CategoryDTO $categoryDTO): bool
    {
        $category = $this->findById($id);

        if ($category === null) {
            throw new CategoryNotFoundException();
        }

        return $category->fill($categoryDTO->jsonSerialize())->save();
    }

    public function delete(int $id): void
    {
        if ($this->category->newQuery()->count() <= 1) {
            return;
        }
        $category = $this->findById($id);
        $category?->delete();
    }
}
