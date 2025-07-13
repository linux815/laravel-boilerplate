<?php

namespace App\Contracts;

use App\Dto\CommentDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\CursorPaginator;

interface CommentRepositoryInterface
{
    public const COMMENTS_PER_PAGE = 5;

    public function findAllPaginated(): CursorPaginator;

    public function findById(int $id): Model|Builder|null;

    public function create(CommentDTO $commentDTO): Model;

    public function update(int $id, CommentDTO $commentDTO): bool;

    public function delete(int $id): void;
}
