<?php

namespace App\Models;

use App\Enums\Driver\AutoAccept;
use App\Enums\Driver\DriverStatus;
use App\Enums\User\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserDriver  extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'user_driver_info';
    protected $fillable = [
        'user_id',
        'avatar',
        'id_card',
        'id_card_front',
        'id_card_back',
        'license_plate',
        'vehicle_company',
        'vehicle_registration_front',
        'vehicle_registration_back',
        'driver_license_front',
        'driver_license_back',
        'bank_name',
        'bank_account_name',
        'bank_account_number',
        'auto_accept',
        'current_lat',
        'current_lng',
        'current_address',
        'order_accepted',
    ];
    protected $casts = [
        'auto_accept' => AutoAccept::class,
        'order_accepted' => DriverStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function scopeDriver($query){
        return $query->whereHas('user', function ($query) {
            $query->where('roles', UserRole::Driver);
        });
    }
}
