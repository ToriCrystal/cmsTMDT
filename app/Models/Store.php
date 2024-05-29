<?php

namespace App\Models;

use App\Casts\OpenHour;
use App\Enums\Store\StoreStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Store extends Authenticatable
{
    use HasFactory;

    protected $dates = ['device_token_updated_at'];
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'open_hours_1' => OpenHour::class,
        'close_hours_1' => OpenHour::class,
        'open_hours_2' => OpenHour::class,
        'close_hours_2' => OpenHour::class,
        'status' => StoreStatus::class,
        'priority' => 'integer',
        'lng' => 'double',
        'lat' => 'double'
    ];

    public function fullAddress(){
        $address = '';
        $address = $this->address_detail ? rtrim($this->address_detail, ',') : $address;
        return $this->address_detail . ', ' . $this->address;
    }

    public function operatingTime1(){
        return $this->open_hours_1 . ' - ' . $this->close_hours_1;
    }

    public function operatingTime2(){

        if($this->open_hours_2 || $this->close_hours_2){
            return $this->open_hours_2 . ' - ' . $this->close_hours_2;
        }
        return null;
    }

    public function category(){
        return $this->belongsTo(StoreCategory::class, 'category_id');
    }

    public function area(){
        return $this->belongsTo(Area::class, 'area_id');
    }
}
