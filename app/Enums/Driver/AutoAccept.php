<?php

namespace App\Enums\Driver;

use App\Supports\Enum;

enum AutoAccept: int
{
    use Enum;

    // Tự động nhận chuyến
    case Auto = 1;

    //tắt nhận chuyến
    case Off = 2;

    //Khoá nhận chuyến
    case Locked = 3;

    public function badge(): string
    {
        return match($this) {
            AutoAccept::Auto => 'bg-green-lt',
            AutoAccept::Off => 'bg-gray-lt',
            AutoAccept::Locked => 'bg-red-lt',
        };
    }
}
