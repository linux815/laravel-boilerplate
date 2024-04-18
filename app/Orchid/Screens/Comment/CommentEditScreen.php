<?php

namespace App\Orchid\Screens\Comment;

use Alert;
use App\Contracts\CommentServiceInterface;
use App\Http\Requests\Comment\DeleteCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class CommentEditScreen extends Screen
{
    public $comment;

    public function __construct(private readonly CommentServiceInterface $commentService)
    {
    }

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Comment $comment): iterable
    {
        return [
            'comment' => $comment,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Edit comment';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Comments";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Update')
                ->icon('note')
                ->method('update')
                ->canSee($this->comment->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->comment->exists),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     * @throws BindingResolutionException
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Relation::make('comment.article_id')
                    ->title('Article')
                    ->fromModel(Article::class, 'title'),

                Relation::make('comment.user_id')
                    ->title('Author')
                    ->fromModel(User::class, 'name'),

                TextArea::make('comment.comment')
                    ->title('Comment')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this article.'),

            ])
        ];
    }

    public function update(UpdateCommentRequest $request): RedirectResponse
    {
        $this->commentService->update($this->comment->id, $request->toDTO());

        Alert::info('You have successfully updated a comment.');

        return redirect()->route('platform.comment.list');
    }

    public function remove(DeleteCommentRequest $request): RedirectResponse
    {
        $this->commentService->delete($this->comment->id);

        Alert::info('You have successfully deleted the comment.');

        return redirect()->route('platform.comment.list');
    }
}
