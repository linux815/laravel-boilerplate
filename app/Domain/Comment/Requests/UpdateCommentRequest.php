<?php

namespace App\Domain\Comment\Requests;

use App\Domain\Comment\Comment;
use App\Domain\Comment\CommentDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('update-comment', Comment::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comment.comment' => 'string|required|max:255',
            'comment.user_id' => 'required|integer|exists:users,id',
            'comment.article_id' => 'required|integer|exists:articles,id',
        ];
    }

    public function toDTO(): CommentDTO
    {
        return new CommentDTO(
            $this->input('comment.comment'),
            $this->input('comment.user_id'),
            $this->input('comment.article_id'),
        );
    }
}
