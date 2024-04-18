<?php

namespace App\Http\Controllers;

use App\Contracts\CommentServiceInterface;
use App\Http\Requests\Comment\StoreCommentRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CommentController extends Controller
{
    public function __construct(private readonly CommentServiceInterface $commentService)
    {
    }

    public function index(): Response
    {
        return Inertia::render('Comment/Index', [
            //
        ]);
    }

    public function store(StoreCommentRequest $request): RedirectResponse
    {
        $this->commentService->store($request->toDTO());
        return redirect(route('articles.show', ['id' => $request->toDTO()->getArticleId()]));
    }
}
