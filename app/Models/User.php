<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\User\AutoNotification;
use App\Enums\User\UserRole;
use App\Supports\Eloquent\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\User\UserStatus;
use App\Enums\Gender;

class User extends Authenticatable
{
    use Sluggable, HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';


    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'fullname',
        'email',
        'phone',
        'birthday',
        'gender',
        'active',
        'avatar',
        'area_id',
        'address',
        'password',
        'status',
        'longitude',
        'latitude',
        'roles',
        'token_get_password',
        'device_token',
        'notification_preference',
        'feature_image'
    ];

    public function area():BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function scopeCustomer($query)
    {
        return $query->where('roles', UserRole::Customer);
    }
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
        'gender' => Gender::class,
        'roles' => UserRole::class,
        'status' => UserStatus::class,
        'notification_preference' => AutoNotification::class,
        'birthday' => 'date'
    ];
}
