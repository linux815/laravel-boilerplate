<?php

namespace App\Domain\Comment\Contracts;

use App\Domain\Comment\CommentDTO;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Model;

interface CommentServiceInterface
{
    public function getPaginated(): CursorPaginator;

    public function get(int $id): ?Model;

    public function store(CommentDTO $commentDTO): Model;

    public function update(int $id, CommentDTO $commentDTO): Model;

    public function delete(int $id): bool;
}
