<?php

namespace App\Enums\Prioritize;

use App\Supports\Enum;

enum Prioritize: int
{
    use Enum;
    /**
     * The product is in stock and available for purchase.
     */
    case Notprocessed = 1;

    /**
     * The product is out of stock and not available for purchase.
     */
    case Processed = 2;




}
