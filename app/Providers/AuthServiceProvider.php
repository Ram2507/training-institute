<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\Permission;
use App\Policies\RolePolicy;
use App\Policies\PermissionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
        \App\Models\Blog::class => \App\Policies\BlogPolicy::class,
    ];

    public function boot(): void
    {
        // Optional: super-admin bypass
        Gate::before(fn (User $user, string $ability) => $user->hasRole('admin') ? true : null);
    }
}
