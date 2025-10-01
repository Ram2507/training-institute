<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;

class RolePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_roles')
            || $user->can('create_roles')
            || $user->can('edit_roles')
            || $user->can('delete_roles');
    }

    public function view(User $user, Role $record): bool
    {
        return $user->can('view_roles');
    }

    public function create(User $user): bool
    {
        return $user->can('create_roles');
    }

    public function update(User $user, Role $record): bool
    {
        return $user->can('edit_roles');
    }

    public function delete(User $user, Role $record): bool
    {
        return $user->can('delete_roles');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_roles');
    }
}
