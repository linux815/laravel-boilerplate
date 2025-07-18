<?php

namespace App\Domain\Article\Services;

use App\Domain\Article\ArticleDTO;
use App\Domain\Article\Contracts\ArticleRepositoryInterface;
use App\Domain\Article\Contracts\ArticleServiceInterface;
use App\Exceptions\ArticleNotFoundException;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Model;

class ArticleService implements ArticleServiceInterface
{
    public function __construct(private readonly ArticleRepositoryInterface $articleRepository) {}

    public function getPaginated(): CursorPaginator
    {
        return $this->articleRepository->findAllPaginated();
    }

    /**
     * @throws ArticleNotFoundException
     */
    public function get(int $id): ?Model
    {
        $article = $this->articleRepository->findById($id);

        if (!$article) {
            throw new ArticleNotFoundException();
        }

        return $article;
    }

    public function store(ArticleDTO $articleDTO): Model
    {
        return $this->articleRepository->create($articleDTO);
    }

    public function update(int $id, ArticleDTO $articleDTO): Model
    {
        return $this->articleRepository->update($id, $articleDTO);
    }

    public function delete(int $id): bool
    {
        return $this->articleRepository->delete($id);
    }

    public function getCountsByCategoryId(int $categoryId): int
    {
        return $this->articleRepository->getCountsByCategoryId($categoryId);
    }
}
