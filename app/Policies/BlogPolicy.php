<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;

class BlogPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_blogs')
            || $user->can('create_blogs')
            || $user->can('edit_blogs')
            || $user->can('delete_blogs');
    }

    public function view(User $user, Blog $blog): bool
    {
        return $user->can('view_blogs');
    }

    public function create(User $user): bool
    {
        return $user->can('create_blogs');
    }

    public function update(User $user, Blog $blog): bool
    {
        return $user->can('edit_blogs');
    }

    public function delete(User $user, Blog $blog): bool
    {
        return $user->can('delete_blogs');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_blogs');
    }
}
