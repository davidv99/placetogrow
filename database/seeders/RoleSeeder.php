<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::create(['name' => 'admin']);
        $role_guest = Role::create(['name' => 'guest']);
        $user = User::find(1);
        $user->assignRole($role_admin);
        $user2 = User::find(2);
        $user2->assignRole($role_guest);
    }
}
