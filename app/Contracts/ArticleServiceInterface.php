<?php

namespace App\Contracts;

use App\Dto\ArticleDTO;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface ArticleServiceInterface
{
    public function getPaginated(): CursorPaginator;

    public function get(int $id): Builder | Model;

    public function store(ArticleDTO $articleDTO): void;

    public function update(int $id, ArticleDTO $articleDTO): void;

    public function delete(int $id): void;
}
