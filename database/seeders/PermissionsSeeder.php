<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $guard = 'web';

        // 1) Define the full permission set (CRUD for Users, Roles, Permissions)
        $allPermissions = [
            // Users
            'view_users', 'create_users', 'edit_users', 'delete_users',
            // Roles
            'view_roles', 'create_roles', 'edit_roles', 'delete_roles',
            // Permissions
            'view_permissions', 'create_permissions', 'edit_permissions', 'delete_permissions',
            // Categories
            'view_categories', 'create_categories', 'edit_categories', 'delete_categories',
            // Blogs
            'view_blogs', 'create_blogs', 'edit_blogs', 'delete_blogs',
        ];

        // 2) Create (or ensure) permissions exist
        foreach ($allPermissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm, 'guard_name' => $guard],
                []
            );
        }

        // 3) Ensure roles exist
        $admin    = Role::firstOrCreate(['name' => 'admin',    'guard_name' => $guard]);
        /*$editor   = Role::firstOrCreate(['name' => 'editor',   'guard_name' => $guard]);
        $employee = Role::firstOrCreate(['name' => 'employee', 'guard_name' => $guard]);

        // 4) Map role -> permissions (based on your examples)
        $editorPermissions = [
            'view_users', 'create_users', 'edit_users',
            'view_roles',
            // (No delete_users on purpose)
        ];

        $employeePermissions = [
            'view_users',
        ];*/

        // 5) Assign permissions
        $admin->syncPermissions($allPermissions);
        //$editor->syncPermissions($editorPermissions);
        //$employee->syncPermissions($employeePermissions);

        // Tip: if you want to *add* instead of *sync*, use ->givePermissionTo([...])
    }
}
