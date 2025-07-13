<?php

namespace App\Orchid\Screens\Comment;

use App\Domain\Comment\Contracts\CommentServiceInterface;
use App\Orchid\Layouts\CommentListLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class CommentListScreen extends Screen
{
    public function __construct(private readonly CommentServiceInterface $commentService) {}

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'comments' => $this->commentService->getPaginated(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Comments list';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            CommentListLayout::class,
        ];
    }
}
