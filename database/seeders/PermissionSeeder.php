<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Permission GA
        $permissions = [
            'view_staff',
            'edit_staff',
            'manage_attendance',
            'view_attendance',
            'approve_attendance',
            'apply_leave',
            'approve_leave',
            'manage_assets',
            'view_assets',
            'manage_reimburse',
            'approve_reimburse',
            'view_reports',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // 2. Roles GA
        $roles = [
            'superadmin' => $permissions, // semua akses
            'admin'      => [
                'view_staff','edit_staff',
                'manage_attendance','approve_attendance',
                'manage_assets','view_assets',
                'manage_reimburse','approve_reimburse',
                'view_reports'
            ],
            'manager'    => [
                'view_staff',
                'approve_attendance','approve_leave',
                'view_reports'
            ],
            'staff'      => [
                'view_staff','apply_leave',
                'manage_attendance'
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }

        // 3. Assign role ke user default (opsional)
        $users = [
            'superadmin@ga.com' => 'superadmin',
            'admin@ga.com' => 'admin',
            'manager@ga.com' => 'manager',
            'staff@ga.com' => 'staff',
        ];

        foreach ($users as $email => $role) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->assignRole($role);
            }
        }
    }
}
