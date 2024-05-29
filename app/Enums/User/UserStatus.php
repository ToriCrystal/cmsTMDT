<?php

namespace App\Enums\User;

use App\Supports\Enum;

enum UserStatus: int
{
    use Enum;

    /** On */
    case Active = 1;

    /** Off */
    case Locked = 2;
}
