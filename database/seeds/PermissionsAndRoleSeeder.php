<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // permissions
        $permissions = [
            [
                'name' => 'admin_users',
                'label' => 'Administrar Usuarios'
            ],
            [
                'name' => 'admin_roles',
                'label' => 'Administrar Roles'
            ]
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate($permission);
        }

        // create admin role
        $roleAdmin = Role::firstOrCreate([
            'name' => 'admin',
            'label' => 'Administrador del sistema'
        ]);

        foreach (Permission::all() as $permission) {
            if (! $roleAdmin->hasPermissionTo($permission)) {
                $roleAdmin->givePermissionTo($permission->name);
            }
        }
    }
}
