<?php

namespace App\Models;

use App\Enums\Order\OrderStatus;
use App\Enums\Payment\PaymentMethod;
use App\Enums\Shipping\ShippingMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Order extends Model
{
    use  HasApiTokens, HasFactory, Notifiable;

    protected $table = 'orders';

    protected $fillable = [
        'code',
        'customer_id',
        'driver_id',
        'store_id',
        'pickup_address',
        'lat',
        'lng',
        'destination_address',
        'destination_lat',
        'destination_lng',
        'shipping_address',
        'shipping_method',
        'payment_method',
        'sub_total',
        'transport_fee',
        'total',
        'system_revenue',
        'status'
    ];

    protected $hidden = [];

    protected $casts = [
        'shipping_method' =>  ShippingMethod::class,
        'payment_method' => PaymentMethod::class,
        'status' => OrderStatus::class,
        'sub_total' => 'double',
        'transport_fee' => 'double',
        'total' => 'double',
        'system_revenue' =>'double'
    ];
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function driver():BelongsTo
    {
        return $this->belongsTo(UserDriver::class, 'driver_id');
    }

    public function store():BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function driverTransactions(): HasMany
    {
        return $this->hasMany(DriverTransaction::class, 'order_id');
    }

}
