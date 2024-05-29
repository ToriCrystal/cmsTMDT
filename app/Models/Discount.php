<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';
    use HasFactory;
    protected $fillable = [
        'code',
        'date_start',
        'date_end',
        'max_usage',
        'min_order_amount',
        'type',
        'discount_value',
    ];
}
