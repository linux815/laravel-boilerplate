<?php

namespace App\Orchid\Layouts;

use App\Domain\Article\Article;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ArticleListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'articles';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->sort()->render(fn(Article $article) => $article->id),
            TD::make('title', 'Title')
                ->render(function (Article $article) {
                    return Link::make($article->title)
                        ->route('platform.article.edit', $article);
                }),
            TD::make('created_at', 'Created')->render(
                fn(Article $article) => $article->created_at->format('Y-m-d H:i:s'),
            ),
            TD::make('updated_at', 'Last edit')->render(
                fn(Article $article) => $article->updated_at->format('Y-m-d H:i:s'),
            ),
        ];
    }
}
