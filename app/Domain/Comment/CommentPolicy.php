<?php

namespace App\Domain\Comment;

use App\Models\User;

class CommentPolicy
{
    public function updateComment(User $user): bool
    {
        return $user->hasAccess('update-comment');
    }

    public function deleteComment(User $user): bool
    {
        return $user->hasAccess('delete-comment');
    }
}
