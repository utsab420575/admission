<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // User
            ['name' => 'user.logout', 'group_name' => 'user'],



            // Permission
            ['name' => 'permission.all', 'group_name' => 'permission'],
            ['name' => 'permission.add', 'group_name' => 'permission'],
            ['name' => 'permission.store', 'group_name' => 'permission'],
            ['name' => 'permission.edit', 'group_name' => 'permission'],
            ['name' => 'permission.update', 'group_name' => 'permission'],
            ['name' => 'permission.delete', 'group_name' => 'permission'],

            // Role
            ['name' => 'roles.all', 'group_name' => 'role'],
            ['name' => 'roles.add', 'group_name' => 'role'],
            ['name' => 'roles.store', 'group_name' => 'role'],
            ['name' => 'roles.edit', 'group_name' => 'role'],
            ['name' => 'roles.update', 'group_name' => 'role'],
            ['name' => 'roles.delete', 'group_name' => 'role'],

            // Role Permissions
            ['name' => 'roles.permissions.add', 'group_name' => 'role_permission'],
            ['name' => 'role.permission.store', 'group_name' => 'role_permission'],
            ['name' => 'roles.permission.all', 'group_name' => 'role_permission'],
            ['name' => 'role.permission.edit', 'group_name' => 'role_permission'],
            ['name' => 'role.permission.update', 'group_name' => 'role_permission'],
            ['name' => 'role.permission.delete', 'group_name' => 'role_permission'],

            // Role Assignment
            ['name' => 'role.assignments.all', 'group_name' => 'role_assignment'],
            ['name' => 'role.assignments.add', 'group_name' => 'role_assignment'],
            ['name' => 'role.assignments.store', 'group_name' => 'role_assignment'],
            ['name' => 'role.assignments.edit', 'group_name' => 'role_assignment'],
            ['name' => 'role.assignments.update', 'group_name' => 'role_assignment'],
            ['name' => 'role.assignments.delete', 'group_name' => 'role_assignment'],


            //menu
            $permissions[] = ['name' => 'role_permission.menu', 'group_name' => 'menu'],
            $permissions[] = ['name' => 'role_assign.menu', 'group_name' => 'menu'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name'], 'guard_name' => 'web'],
                [
                    'group_name' => $permission['group_name'],
                    'created_at' => Carbon::now(),
                ]
            );
        }
    }
}
