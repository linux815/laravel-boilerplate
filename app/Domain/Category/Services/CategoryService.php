<?php

namespace App\Domain\Category\Services;

use App\Domain\Article\Contracts\ArticleServiceInterface;
use App\Domain\Category\CategoryDTO;
use App\Domain\Category\Contracts\CategoryRepositoryInterface;
use App\Domain\Category\Contracts\CategoryServiceInterface;
use App\Exceptions\CategoryNotFoundException;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CategoryService implements CategoryServiceInterface
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly ArticleServiceInterface $articleService,
    ) {}

    public function getPaginated(): CursorPaginator
    {
        return $this->categoryRepository->findAllPaginated();
    }

    /**
     * @throws CategoryNotFoundException
     */
    public function get(int $id): Builder|Model
    {
        $article = $this->categoryRepository->findById($id);

        if (!$article) {
            throw new CategoryNotFoundException();
        }

        return $article;
    }

    public function store(CategoryDTO $categoryDTO): void
    {
        $this->categoryRepository->create($categoryDTO);
    }

    public function update(int $id, CategoryDTO $categoryDTO): void
    {
        $this->categoryRepository->update($id, $categoryDTO);
    }

    public function delete(int $id): void
    {
        $this->categoryRepository->delete($id);
    }

    public function canDelete(int $id): bool
    {
        $counts = $this->articleService->getCountsByCategoryId($id);
        return $counts < 1;
    }
}
