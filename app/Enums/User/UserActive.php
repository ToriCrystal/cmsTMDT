<?php

namespace App\Enums\User;

use App\Supports\Enum;

enum UserActive: int
{
    use Enum;

    case Off = 1;
    case On = 2;
}
