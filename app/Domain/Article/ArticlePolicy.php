<?php

namespace App\Domain\Article;

use App\Models\User;

class ArticlePolicy
{
    public function createArticle(User $user): bool
    {
        return $user->hasAccess('create-article');
    }

    public function updateArticle(User $user): bool
    {
        return $user->hasAccess('update-article');
    }

    public function deleteArticle(User $user): bool
    {
        return $user->hasAccess('delete-article');
    }

}
