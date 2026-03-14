<?php

namespace App\Models;

class Role
{
    public const ADMIN = 'admin';
    public const CUSTOMER = 'customer';

    public static function all(): array
    {
        return [
            self::ADMIN,
            self::CUSTOMER,
        ];
    }
}
