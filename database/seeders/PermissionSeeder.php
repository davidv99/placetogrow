<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $super_admin_role = Role::where('name', 'super_admin')->first();
        $admin_role = Role::where('name', 'admin')->first();
        $guest_role = Role::where('name', 'guest')->first();

        Permission::create(['name' => 'user.edit'])->syncRoles([$super_admin_role, $admin_role]);
    }
}
