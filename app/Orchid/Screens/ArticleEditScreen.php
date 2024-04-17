<?php

namespace App\Orchid\Screens;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
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
                ->method('createOrUpdate')
                ->canSee(!$this->article->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
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

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request)
    {
        $this->article->fill($request->get('article'))->save();

        \Alert::info('You have successfully created a article.');

        return redirect()->route('platform.article.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove()
    {
        $this->article->delete();

        \Alert::info('You have successfully deleted the article.');

        return redirect()->route('platform.article.list');
    }
}
