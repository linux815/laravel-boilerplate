<?php

namespace App\Orchid\Layouts;

use App\Domain\Comment\Comment;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CommentListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'comments';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('comment', 'Comment')
                ->render(function (Comment $comment) {
                    return Link::make($comment->comment)
                        ->route('platform.comment.edit', $comment);
                }),

            TD::make('author', 'Author')
                ->render(function (Comment $comment) {
                    return Link::make($comment->user->name)
                        ->route('platform.comment.edit', $comment);
                }),

            TD::make('created_at', 'Created')->sort()->render(
                fn(Comment $comment) => $comment->created_at->format('Y-m-d H:i:s'),
            ),
            TD::make('updated_at', 'Updated')->sort()->render(
                fn(Comment $comment) => $comment->updated_at->format('Y-m-d H:i:s'),
            ),
        ];
    }
}
