<?php

namespace App\Domain\Comment;

class CommentDTO
{
    public function __construct(
        private readonly string $comment,
        private readonly int $userId,
        private readonly int $articleId,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'comment' => $this->getComment(),
            'user_id' => $this->getUserId(),
            'article_id' => $this->getArticleId(),
        ];
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }
}
