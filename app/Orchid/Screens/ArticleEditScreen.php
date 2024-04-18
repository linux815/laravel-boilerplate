<?php

namespace App\Orchid\Screens;

use Alert;
use App\Contracts\ArticleServiceInterface;
use App\Http\Requests\DeleteArticleRequest;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ArticleEditScreen extends Screen
{
    public $article;

    public function __construct(private readonly ArticleServiceInterface $articleService)
    {
    }

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Article $article): iterable
    {
        return [
            'article' => $article,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->article->exists ? 'Edit article' : 'Creating a new article';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Articles";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create article')
                ->icon('pencil')
                ->method('create')
                ->canSee(!$this->article->exists),

            Button::make('Update')
                ->icon('note')
                ->method('update')
                ->canSee($this->article->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->article->exists),
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
                Input::make('article.title')
                    ->title('Title')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this article.'),

                Relation::make('article.category_id')
                    ->title('Category')
                    ->fromModel(Category::class, 'name'),

                Relation::make('article.user_id')
                    ->title('Author')
                    ->fromModel(User::class, 'name'),

                Quill::make('article.content')
                    ->title('Main text'),

            ])
        ];
    }

    public function create(StoreArticleRequest $request): RedirectResponse
    {
        $this->articleService->store($request->toDTO());

        Alert::info('You have successfully created a article.');

        return redirect()->route('platform.article.list');
    }

    public function update(UpdateArticleRequest $request): RedirectResponse
    {
        $this->articleService->update($this->article->id, $request->toDTO());

        Alert::info('You have successfully updated a article.');

        return redirect()->route('platform.article.list');
    }

    public function remove(DeleteArticleRequest $request): RedirectResponse
    {
        $this->articleService->delete($this->article->id);

        Alert::info('You have successfully deleted the article.');

        return redirect()->route('platform.article.list');
    }
}
