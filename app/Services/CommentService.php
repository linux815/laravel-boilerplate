<?php

namespace App\Services;

use App\Contracts\CommentRepositoryInterface;
use App\Contracts\CommentServiceInterface;
use App\Dto\CommentDTO;
use App\Exceptions\CommentNotFoundException;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CommentService implements CommentServiceInterface
{
    public function __construct(private readonly CommentRepositoryInterface $commentRepository)
    {
    }

    public function getPaginated(): CursorPaginator
    {
        return $this->commentRepository->findAllPaginated();
    }

    /**
     * @throws CommentNotFoundException
     */
    public function get(int $id): Builder|Model
    {
        $comment = $this->commentRepository->findById($id);

        if (!$comment) {
            throw new CommentNotFoundException();
        }

        return $comment;
    }

    public function store(CommentDTO $commentDTO): void
    {
        $this->commentRepository->create($commentDTO);
    }

    public function update(int $id, CommentDTO $commentDTO): void
    {
        $this->commentRepository->update($id, $commentDTO);
    }

    public function delete(int $id): void
    {
        $this->commentRepository->delete($id);
    }
}
