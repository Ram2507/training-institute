<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_users')
            || $user->can('create_users')
            || $user->can('edit_users')
            || $user->can('delete_users');
    }

    public function view(User $user, User $record): bool
    {
        return $user->can('view_users');
    }

    public function create(User $user): bool
    {
        return $user->can('create_users');
    }

    public function update(User $user, User $record): bool
    {
        return $user->can('edit_users');
    }

    public function delete(User $user, User $record): bool
    {
        return $user->can('delete_users');
    }

    // (optional) bulk/force/restore variants if you use those actions:
    public function deleteAny(User $user): bool { return $user->can('delete_users'); }
}
