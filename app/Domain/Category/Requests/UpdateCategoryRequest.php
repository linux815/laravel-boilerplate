<?php

namespace App\Domain\Category\Requests;

use App\Domain\Category\Category;
use App\Domain\Category\CategoryDTO;
use Gate;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('update-category', Category::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category.name' => 'string|required|max:255',
        ];
    }

    public function toDTO(): CategoryDTO
    {
        return new CategoryDTO(
            $this->input('category.name'),
        );
    }
}
