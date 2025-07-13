<?php

namespace App\Http\Requests\Comment;

use App\Dto\CommentDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comment' => 'string|required|max:255',
            'article_id' => 'required|integer|exists:articles,id',
        ];
    }

    public function toDTO(): CommentDTO
    {
        return new CommentDTO(
            $this->input('comment'),
            auth()->user()->id,
            $this->input('article_id'),
        );
    }
}
