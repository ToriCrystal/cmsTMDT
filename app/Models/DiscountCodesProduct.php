<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCodesProduct extends Model
{
    use HasFactory;
    protected $table = 'discount_codes_products';

    protected $fillable = [
        'discount_code_id',
        'product_id',
    ];

    public function discountCode()
    {
        return $this->belongsTo(Discount::class, 'discount_code_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
