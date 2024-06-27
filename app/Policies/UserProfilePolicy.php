<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserProfilePolicy
{
    use HandlesAuthorization;

    public function view(User $loggedInUser, User $targetUser)
    {
        // Verificar si el usuario autenticado es el mismo que el usuario objetivo
        $isOwner = $loggedInUser->id === $targetUser->id;

        // Verificar si el usuario autenticado tiene el rol 'guest'
        $hasGuestRole = $loggedInUser->hasRole('guest');

        // Permitir el acceso si es propietario y tiene el rol 'guest'
        return $isOwner && $hasGuestRole;
    }
}
