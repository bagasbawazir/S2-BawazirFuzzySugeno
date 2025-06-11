<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Find User
        $administrator = User::findOrFail(1);
        $employee = User::findOrFail(2);

        // Find Role
        $role_admin = Role::findOrFail(1);
        $role_employee = Role::findOrFail(2);

        // Give Role to User
        $administrator->assignRole($role_admin);
        $employee->assignRole($role_employee);

        //Give Role Permissions for Admin
        $permissions = Permission::pluck('id', 'id')->all();
        $role_admin->syncPermissions($permissions);

        //Give Role Permissions for Employee
        $permissions = Permission::whereIn('id', [1, 2, 3, 6, 7, 8, 11, 12, 16, 17, 19, 20, 21])->get();
        $role_employee->syncPermissions($permissions);
    }
}
