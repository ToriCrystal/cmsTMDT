<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Rates extends Model
{
    use  HasApiTokens, HasFactory, Notifiable;

    protected $table = 'rates';

    protected $fillable = [
        'user_id',
        'order_acceptance_rate',
        'order_completion_rate',
        'order_cancellation_rate',
    ];

    protected $casts = [
        'order_acceptance_rate' => 'double',
        'order_completion_rate' => 'double',
        'order_cancellation_rate' => 'double',
    ];

    public function userdriver()
    {
        return $this->belongsTo(UserDriver::class, 'id', 'user_id');
    }
}
