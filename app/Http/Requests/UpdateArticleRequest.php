<?php

namespace App\Http\Requests;

use App\Dto\ArticleDTO;
use App\Models\Article;
use Gate;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('update-article', Article::class);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'article.title' => 'string|required|max:255',
            'article.content' => 'string|required|max:5000',
            'article.user_id' => 'required|integer|exists:users,id',
            'article.category_id' => 'required|integer|exists:categories,id',
        ];
    }

    public function toDTO(): ArticleDTO
    {
        return new ArticleDTO(
            $this->input('article.title'),
            $this->input('article.content'),
            $this->input('article.user_id'),
            $this->input('article.category_id'),
        );
    }
}
