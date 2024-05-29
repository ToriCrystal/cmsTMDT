<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class OrderItem extends Model
{
    use  HasApiTokens, HasFactory, Notifiable;

    protected $table = 'order_items';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'order_id',
        'unit_price',
        'qty'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
