<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'add_user',
            'show_user',
            'edit_user',
            'delete_user',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission],
                [
                    'name' => $permission,
                    'guard_name' => 'admin'
                ]);
        }
    }
}
