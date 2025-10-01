<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Permission;

class PermissionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_permissions')
            || $user->can('create_permissions')
            || $user->can('edit_permissions')
            || $user->can('delete_permissions');
    }

    public function view(User $user, Permission $record): bool
    {
        return $user->can('view_permissions');
    }

    public function create(User $user): bool
    {
        return $user->can('create_permissions');
    }

    public function update(User $user, Permission $record): bool
    {
        return $user->can('edit_permissions');
    }

    public function delete(User $user, Permission $record): bool
    {
        return $user->can('delete_permissions');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_permissions');
    }
}
