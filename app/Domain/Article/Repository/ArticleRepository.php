<?php

namespace App\Domain\Article\Repository;

use App\Domain\Article\Article;
use App\Domain\Article\ArticleDTO;
use App\Domain\Article\Contracts\ArticleRepositoryInterface;
use App\Exceptions\ArticleNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Facades\DB;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function __construct(private readonly Article $article) {}

    public function findAllPaginated(): CursorPaginator
    {
        return $this->article
            ->newQuery()
            ->with('category')
            ->filters()
            ->select([
                'articles.*',
                DB::raw('articles.id as article_id'),
            ])
            ->orderByDesc('article_id')
            ->cursorPaginate(self::ARTICLES_PER_PAGE);
    }

    public function create(ArticleDTO $articleDTO): Model
    {
        return $this->article->newQuery()->create($articleDTO->jsonSerialize());
    }

    /**
     * @throws ArticleNotFoundException
     */
    public function update(int $id, ArticleDTO $articleDTO): Model
    {
        $article = $this->findOrFail($id);
        $article->fill($articleDTO->jsonSerialize());
        $article->save();

        return $article;
    }

    /**
     * @throws ArticleNotFoundException
     */
    public function findOrFail(int $id): Model
    {
        return $this->findById($id) ?? throw new ArticleNotFoundException();
    }

    public function findById(int $id): ?Model
    {
        return $this->article
            ->newQuery()
            ->with('category', 'comments')
            ->find($id);
    }

    /**
     * @throws ArticleNotFoundException
     */
    public function delete(int $id): bool
    {
        $article = $this->findOrFail($id);

        return (bool)$article->delete();
    }

    public function getCountsByCategoryId(int $categoryId): int
    {
        return $this->article
            ->newQuery()
            ->where('category_id', $categoryId)
            ->count();
    }
}
