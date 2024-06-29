<?php

namespace App\Policies;

use App\Constants\PermissionSlug;
use App\Models\User;

class RolePermissionPolicy
{

    public function viewAny(User $user)
    {
        // return $user->hasPermissionTo(PermissionSlug::MICROSITES_VIEW_ANY);
    }
}
