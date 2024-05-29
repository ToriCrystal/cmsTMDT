<?php

namespace App\Enums\Product;

use App\Supports\Enum;

enum Obligatory: int
{
    use Enum;
    /**
     * The product is in stock and available for purchase.
     */
    case Obligatory = 0;

    /**
     * The product is out of stock and not available for purchase.
     */
    case NoObligatory = 1;




}
