<?php

namespace App\Contracts;

use App\Dto\CommentDTO;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface CommentServiceInterface
{
    public function getPaginated(): CursorPaginator;

    public function get(int $id): Builder|Model;

    public function store(CommentDTO $commentDTO): void;

    public function update(int $id, CommentDTO $commentDTO): void;

    public function delete(int $id): void;
}
