<?php

namespace App\Orchid\Screens\Category;

use App\Domain\Category\Category;
use App\Domain\Category\Contracts\CategoryServiceInterface;
use App\Domain\Category\Requests\DeleteCategoryRequest;
use App\Domain\Category\Requests\StoreCategoryRequest;
use App\Domain\Category\Requests\UpdateCategoryRequest;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class CategoryEditScreen extends Screen
{
    public $category;

    public function __construct(private readonly CategoryServiceInterface $categoryService) {}

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Category $category): iterable
    {
        $this->authorize('update-category', $category);

        return [
            'category' => $category,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->category->exists ? 'Edit category' : 'Creating a new category';
    }

    public function description(): ?string
    {
        return "Categories";
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create category')
                ->icon('pencil')
                ->method('create')
                ->canSee(!$this->category->exists),

            Button::make('Update')
                ->icon('note')
                ->method('update')
                ->canSee($this->category->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->category->exists && $this->categoryService->canDelete($this->category->id)),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('category.name')
                    ->title('Name')
                    ->placeholder('Enter the name of the category'),
            ]),
        ];
    }


    public function create(StoreCategoryRequest $request): RedirectResponse
    {
        $this->categoryService->store($request->toDTO());

        Alert::info('You have successfully created a category.');

        return redirect()->route('platform.category.list');
    }

    public function update(UpdateCategoryRequest $request): RedirectResponse
    {
        $this->categoryService->update($this->category->id, $request->toDTO());

        \Alert::info('You have successfully updated a category.');

        return redirect()->route('platform.category.list');
    }

    public function remove(DeleteCategoryRequest $request): RedirectResponse
    {
        $this->categoryService->delete($this->category->id);

        \Alert::info('You have successfully deleted the category.');

        return redirect()->route('platform.category.list');
    }
}
