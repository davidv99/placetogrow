<?php

namespace App\Policies;

use App\Constants\PermissionSlug;
use App\Models\User;
use App\Models\Microsites;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class micrositesPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionSlug::MICROSITES_VIEW_ANY);
    }

 
    public function view(User $user, Microsites $microsites): bool
    {
        return $user->hasPermissionTo(PermissionSlug::MICROSITES_VIEW);
    }

 
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionSlug::MICROSITES_CREATE);
    }


    public function update(User $user, Microsites $microsites): bool
    {
        return $user->hasPermissionTo(PermissionSlug::MICROSITES_UPDATE);
    }

    public function delete(User $user, Microsites $microsites): bool
    {
        return $user->hasPermissionTo(PermissionSlug::MICROSITES_DELETE);
    }

    public function restore(User $user, Microsites $microsites): bool
    {
        return $user->hasPermissionTo(PermissionSlug::MICROSITES_UPDATE);
    }
}
