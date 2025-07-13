<?php

namespace App\Http\Controllers;

use App\Contracts\ArticleServiceInterface;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ArticleController extends Controller
{
    public function __construct(private readonly ArticleServiceInterface $articleService) {}

    public function index(Request $request): Response|ResponseFactory|CursorPaginator
    {
        $articles = $this->articleService->getPaginated();

        if ($request->wantsJson()) {
            return $articles;
        }

        return inertia('Articles', compact('articles'));
    }

    public function show(Request $request, $id): Response|ResponseFactory
    {
        $article = $this->articleService->get($id);

        return inertia('Article/Show', compact('article'));
    }
}
