<?php

namespace App\Repository;

use App\Contracts\CommentRepositoryInterface;
use App\Dto\CommentDTO;
use App\Exceptions\CommentNotFoundException;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\CursorPaginator;

class CommentRepository implements CommentRepositoryInterface
{
    public function __construct(private readonly Comment $comment)
    {
    }

    public function findAllPaginated(): CursorPaginator
    {
        return $this->comment->newQuery()
            ->filters()
            ->latest()
            ->cursorPaginate(self::COMMENTS_PER_PAGE);
    }

    public function findById(int $id): Builder | Model | null
    {
        return $this->comment->newQuery()->find($id);
    }

    public function create(CommentDTO $commentDTO): Model
    {
        return $this->comment->newQuery()->create($commentDTO->jsonSerialize());
    }

    public function update(int $id, CommentDTO $commentDTO): bool
    {
        $comment = $this->findById($id);

        if ($comment === null) {
            throw new CommentNotFoundException();
        }

        return $comment->fill($commentDTO->jsonSerialize())->save();
    }

    public function delete(int $id): void
    {
        $comment = $this->findById($id);
        $comment?->delete();
    }
}
