<?php

namespace App\Http\Controllers;

use App\Domain\Comment\Contracts\CommentServiceInterface;
use App\Domain\Comment\Requests\StoreCommentRequest;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function __construct(private readonly CommentServiceInterface $commentService) {}

    public function store(StoreCommentRequest $request): RedirectResponse
    {
        $this->commentService->store($request->toDTO());
        return redirect(route('articles.show', ['id' => $request->toDTO()->getArticleId()]));
    }
}
