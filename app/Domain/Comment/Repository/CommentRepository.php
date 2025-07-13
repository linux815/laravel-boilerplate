<?php

namespace App\Domain\Comment\Repository;

use App\Domain\Comment\Comment;
use App\Domain\Comment\CommentDTO;
use App\Domain\Comment\Contracts\CommentRepositoryInterface;
use App\Exceptions\CommentNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\CursorPaginator;

class CommentRepository implements CommentRepositoryInterface
{
    public function __construct(private readonly Comment $comment) {}

    public function findAllPaginated(): CursorPaginator
    {
        return $this->comment
            ->newQuery()
            ->filters()
            ->latest()
            ->cursorPaginate(self::COMMENTS_PER_PAGE);
    }

    public function create(CommentDTO $commentDTO): Model
    {
        return $this->comment->newQuery()->create($commentDTO->jsonSerialize());
    }

    /**
     * @throws CommentNotFoundException
     */
    public function update(int $id, CommentDTO $commentDTO): Model
    {
        $comment = $this->findOrFail($id);
        $comment->fill($commentDTO->jsonSerialize());
        $comment->save();

        return $comment;
    }

    /**
     * @throws CommentNotFoundException
     */
    public function findOrFail(int $id): Model
    {
        return $this->findById($id) ?? throw new CommentNotFoundException();
    }

    public function findById(int $id): ?Model
    {
        return $this->comment->newQuery()->find($id);
    }

    /**
     * @throws CommentNotFoundException
     */
    public function delete(int $id): bool
    {
        $comment = $this->findOrFail($id);
        return (bool)$comment->delete();
    }
}
