<?php

declare(strict_types=1);

namespace App\Constants;

final class PermissionSlug
{
    public const  CATEGORIES_VIEW_ANY = 'categories.view_any';
    public const  CATEGORIES_VIEW = 'categories.view';
    public const  CATEGORIES_CREATE = 'categories.create';
    public const  CATEGORIES_UPDATE = 'categories.update';
    public const  CATEGORIES_DELETE = 'categories.delete';

    public const  MICROSITES_VIEW_ANY = 'microsites.view_any';
    public const  MICROSITES_VIEW = 'microsites.view';
    public const  MICROSITES_CREATE = 'microsites.create';
    public const  MICROSITES_UPDATE = 'microsites.update';
    public const  MICROSITES_DELETE = 'microsites.delete';

    public static function toArray(): array
    {
        return (new \ReflectionClass(self::class))->getConstants();
    }
}
