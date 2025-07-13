<?php

namespace App\Http\Controllers\Api;

use App\Domain\Article\Contracts\ArticleServiceInterface;
use Illuminate\Http\JsonResponse;

class ArticleController
{
    public function __construct(private readonly ArticleServiceInterface $articleService) {}

    public function __invoke(): JsonResponse
    {
        return response()->json($this->articleService->getPaginated());
    }
}
