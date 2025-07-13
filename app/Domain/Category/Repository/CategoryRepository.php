<?php

namespace App\Domain\Category\Repository;

use App\Domain\Category\Category;
use App\Domain\Category\CategoryDTO;
use App\Domain\Category\Contracts\CategoryRepositoryInterface;
use App\Exceptions\CategoryNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\CursorPaginator;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(private readonly Category $category) {}

    public function findAllPaginated(): CursorPaginator
    {
        return $this->category
            ->newQuery()
            ->filters()
            ->latest()
            ->cursorPaginate(self::CATEGORY_PER_PAGE);
    }

    public function create(CategoryDTO $categoryDTO): Model
    {
        return $this->category->newQuery()->create($categoryDTO->jsonSerialize());
    }

    /**
     * @throws CategoryNotFoundException
     */
    public function update(int $id, CategoryDTO $categoryDTO): Model
    {
        $category = $this->findOrFail($id);
        $category->fill($categoryDTO->jsonSerialize());
        $category->save();

        return $category;
    }

    /**
     * @throws CategoryNotFoundException
     */
    public function findOrFail(int $id): Model
    {
        return $this->findById($id) ?? throw new CategoryNotFoundException();
    }

    public function findById(int $id): ?Model
    {
        return $this->category->newQuery()->find($id);
    }

    /**
     * @throws CategoryNotFoundException
     */
    public function delete(int $id): bool
    {
        if ($this->category->newQuery()->count() <= 1) {
            return false;
        }
        $category = $this->findOrFail($id);
        return (bool)$category->delete();
    }
}
