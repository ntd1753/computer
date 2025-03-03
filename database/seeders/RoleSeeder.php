<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::truncate();
        Permission::truncate();

        $permissions = [
            'manage_users',
            'manage_roles',
            'create_products',
            'edit_products',
            'delete_products',
            'manage_comments',
            'manage_complaints',
            'create_posts',
            'edit_own_posts',
            'delete_own_posts',
            "delete_all_posts",
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $superAdmin = Role::create(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $staff = Role::create(['name' => 'staff']);
        $staff->givePermissionTo(['create_products', 'edit_products', 'delete_products']);

        $customerService = Role::create(['name' => 'customer-service']);
        $customerService->givePermissionTo(['manage_comments', 'manage_complaints']);

        $blogger = Role::create(['name' => 'blogger']);
        $blogger->givePermissionTo(['create_posts', 'edit_own_posts', 'delete_own_posts']);
    }
}
