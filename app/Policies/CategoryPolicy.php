<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_categories')
            || $user->can('create_categories')
            || $user->can('edit_categories')
            || $user->can('delete_categories');
    }

    public function view(User $user, Category $category): bool
    {
        return $user->can('view_categories');
    }

    public function create(User $user): bool
    {
        return $user->can('create_categories');
    }

    public function update(User $user, Category $category): bool
    {
        return $user->can('edit_categories');
    }

    public function delete(User $user, Category $category): bool
    {
        return $user->can('delete_categories');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_categories');
    }
}
