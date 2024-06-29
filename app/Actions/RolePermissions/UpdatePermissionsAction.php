<?php

namespace App\Actions\RolePermissions;

use Spatie\Permission\Models\Role;

class UpdatePermissionsAction
{
    public function execute(Role $role, array $permissions): void
    {
        $role->syncPermissions($permissions);
    }
}