<?php

namespace App\Domain\Comment\Contracts;

use App\Domain\Comment\CommentDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\CursorPaginator;

interface CommentRepositoryInterface
{
    public const COMMENTS_PER_PAGE = 5;

    public function findAllPaginated(): CursorPaginator;

    public function findById(int $id): ?Model;

    public function create(CommentDTO $commentDTO): Model;

    public function update(int $id, CommentDTO $commentDTO): Model;

    public function delete(int $id): bool;
}
