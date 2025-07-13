<?php

namespace App\Domain\Comment\Services;

use App\Domain\Comment\CommentDTO;
use App\Domain\Comment\Contracts\CommentRepositoryInterface;
use App\Domain\Comment\Contracts\CommentServiceInterface;
use App\Exceptions\CommentNotFoundException;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Model;

class CommentService implements CommentServiceInterface
{
    public function __construct(private readonly CommentRepositoryInterface $commentRepository) {}

    public function getPaginated(): CursorPaginator
    {
        return $this->commentRepository->findAllPaginated();
    }

    /**
     * @throws CommentNotFoundException
     */
    public function get(int $id): ?Model
    {
        $comment = $this->commentRepository->findById($id);

        if (!$comment) {
            throw new CommentNotFoundException();
        }

        return $comment;
    }

    public function store(CommentDTO $commentDTO): Model
    {
        return $this->commentRepository->create($commentDTO);
    }

    public function update(int $id, CommentDTO $commentDTO): Model
    {
        return $this->commentRepository->update($id, $commentDTO);
    }

    public function delete(int $id): bool
    {
        return $this->commentRepository->delete($id);
    }
}
