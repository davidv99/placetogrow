<?php

namespace Database\Seeders;

use App\Constants\PermissionSlug;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DefaultRolesAndPermissionsSeeder extends Seeder
{

    public function run(): void
    {
        $baseRolesPermission = [
            [
                'name' => 'Admin',
                'permissions' => [
                    PermissionSlug::CATEGORIES_VIEW_ANY,
                    PermissionSlug::CATEGORIES_CREATE,
                    PermissionSlug::CATEGORIES_UPDATE,
                    PermissionSlug::CATEGORIES_DELETE,
                    PermissionSlug::MICROSITES_VIEW_ANY,
                    PermissionSlug::MICROSITES_VIEW,
                    PermissionSlug::MICROSITES_CREATE,
                    PermissionSlug::MICROSITES_UPDATE,
                    PermissionSlug::MICROSITES_DELETE,

                ],
            ],
            [
                'name' => 'Customer',
                'permissions' => [

                    PermissionSlug::MICROSITES_VIEW,

                ],
            ],
            [
                'name' => 'Guests',
                'permissions' => [],
            ],
        ];

        foreach ($baseRolesPermission as $role) {
            $rol = Role::query()->updateOrCreate([
                'name' => $role['name'],
            ]);

            $rol->syncPermissions($role['permissions']);
        }

        User::query()->find(1)
            ->assignRole('Admin');

        User::query()->find(2)
            ->assignRole('Customer');
    }
}
