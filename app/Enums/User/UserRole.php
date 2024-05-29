<?php

namespace App\Enums\User;

use App\Supports\Enum;

enum UserRole: int
{
    use Enum;

    case Driver = 1;
    case Customer = 2;

    public function badge(): string
    {
        return match($this) {
            UserRole::Driver => 'bg-green-lt',
            UserRole::Customer => 'bg-red-lt',
        };
    }
}
