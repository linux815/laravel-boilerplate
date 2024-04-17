<?php

namespace App\Repository;

use App\Contracts\ArticleRepositoryInterface;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\CursorPaginator;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function __construct(private readonly Article $article)
    {
    }

    public function findAllPaginated(): CursorPaginator
    {
        return $this->article->with('category')
            ->newQuery()
            ->latest()
            ->cursorPaginate(self::ARTICLES_PER_PAGE);
    }

    public function findById(int $id): Builder | Model | null
    {
        return $this->article->with('category')->newQuery()->find($id);
    }
}
