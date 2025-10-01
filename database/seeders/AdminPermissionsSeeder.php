<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class AdminPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure admin role exists
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // Give ALL permissions to admin role
        $adminRole->syncPermissions(Permission::all());

        // (Optional) assign admin role to your admin user
        // Set ADMIN_EMAIL in .env to your existing admin account
        $adminEmail = env('ADMIN_EMAIL');
        if ($adminEmail && ($user = User::where('email', $adminEmail)->first())) {
            $user->syncRoles([$adminRole->name]);
        }
    }
}
