<?php

namespace App\Dto;

class ArticleDTO
{
    public function __construct(
        private readonly string $title,
        private readonly string $content,
        private readonly int $userId,
        private readonly int $categoryId,
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function jsonSerialize(): array
    {
        return [
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
            'user_id' => $this->getUserId(),
            'category_id' => $this->getCategoryId(),
        ];
    }
}
