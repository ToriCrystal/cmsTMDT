<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Point extends Model
{
    use HasFactory,NodeTrait;

    protected $table = 'points';

    protected $fillable = [
        'user_id',
        'total_score',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
