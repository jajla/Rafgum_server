<?php

namespace App\Enums;

enum Roles: string
{
    case Admin = 'admin';
    case User = 'user';
    case Guest = 'guest';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Admin => 'Administrator',
            self::User => 'Klient',
            self::Guest => 'Gosc'
        };
    }
}
