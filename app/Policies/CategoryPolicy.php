<?php

namespace App\Policies;

use App\Constants\PermissionSlug;
use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionSlug::CATEGORIES_VIEW_ANY);
    }


    public function view(User $user, Category $category): bool
    {
        return $user->hasPermissionTo(PermissionSlug::CATEGORIES_VIEW);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionSlug::CATEGORIES_CREATE);
    }

    public function update(User $user, Category $category): bool
    {
        return $user->hasPermissionTo(PermissionSlug::CATEGORIES_UPDATE);
    }

    public function delete(User $user, Category $category): bool
    {
        return $user->hasPermissionTo(PermissionSlug::CATEGORIES_DELETE);
    }

    public function restore(User $user, Category $category): bool
    {
        return $user->hasPermissionTo(PermissionSlug::CATEGORIES_UPDATE);
    }
}
