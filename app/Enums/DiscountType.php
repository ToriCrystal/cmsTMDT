<?php

namespace App\Enums;

use App\Supports\Enum;

enum DiscountType : int {
    use Enum;

    case Money = 1;
    case Percent = 2;

}