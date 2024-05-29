<?php

namespace App\Enums\Product;

use App\Supports\Enum;

enum StockStatus: int
{
    use Enum;
    /**
     * The product is in stock and available for purchase.
     */
    case InStock = 1;

    /**
     * The product is out of stock and not available for purchase.
     */
    case OutOfStock = 2;




}
