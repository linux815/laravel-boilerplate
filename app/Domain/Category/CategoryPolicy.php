<?php

namespace App\Domain\Category;

use App\Models\User;

class CategoryPolicy
{
    public function createCategory(User $user): bool
    {
        return $user->hasAccess('create-category');
    }

    public function updateCategory(User $user): bool
    {
        return $user->hasAccess('update-category');
    }

    public function deleteCategory(User $user): bool
    {
        return $user->hasAccess('delete-category');
    }

}
