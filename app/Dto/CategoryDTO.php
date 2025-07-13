<?php

namespace App\Dto;

class CategoryDTO
{
    public function __construct(private readonly string $name) {}

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
