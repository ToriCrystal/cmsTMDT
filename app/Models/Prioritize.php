<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prioritize extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id',
        'day',
        'total',
        'status',
        'priority_expiration_date',
    ];
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
