<?php

namespace App\Domain\Article\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'min:1'],
        ];
    }


    public function validationData(): ?array
    {
        return $this->route()?->parameters();
    }
}
