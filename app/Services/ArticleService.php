<?php

namespace App\Services;

use App\Contracts\ArticleRepositoryInterface;
use App\Contracts\ArticleServiceInterface;
use App\Exceptions\ArticleNotFoundException;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ArticleService implements ArticleServiceInterface
{
    public function __construct(private readonly ArticleRepositoryInterface $articleRepository)
    {
    }

    public function getPaginated(): CursorPaginator
    {
        return $this->articleRepository->findAllPaginated();
    }

    /**
     * @throws ArticleNotFoundException
     */
    public function get(int $id): Builder | Model
    {
        $article = $this->articleRepository->findById($id);

        if (!$article) {
            throw new ArticleNotFoundException();
        }

        return $article;
    }
}
