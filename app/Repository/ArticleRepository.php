<?php

namespace App\Repository;

use App\Contracts\ArticleRepositoryInterface;
use App\Dto\ArticleDTO;
use App\Exceptions\ArticleNotFoundException;
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
            ->filters()
            ->latest()
            ->cursorPaginate(self::ARTICLES_PER_PAGE);
    }

    public function findById(int $id): Builder | Model | null
    {
        return $this->article->with('category', 'comments')->newQuery()->find($id);
    }

    public function create(ArticleDTO $articleDTO): Model
    {
        return $this->article->newQuery()->create($articleDTO->jsonSerialize());
    }

    /**
     * @throws ArticleNotFoundException
     */
    public function update(int $id, ArticleDTO $articleDTO): bool
    {
        $article = $this->findById($id);

        if ($article === null) {
            throw new ArticleNotFoundException();
        }

        return $article->fill($articleDTO->jsonSerialize())->save();
    }

    public function delete(int $id): void
    {
        $article = $this->findById($id);
        $article?->delete();
    }

    public function getCountsByCategoryId(int $categoryId): int
    {
        return $this->article->newQuery()->where('category_id', $categoryId)->count();
    }
}
