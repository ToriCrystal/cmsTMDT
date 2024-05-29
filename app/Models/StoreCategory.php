<?php

namespace App\Models;

use App\Enums\DefaultStatus;
use App\Supports\Eloquent\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class StoreCategory extends Model
{
    use HasFactory, NodeTrait, Sluggable;
    
    protected $table = 'store_categories';

    protected $guarded = [];

    protected $casts = [
        'status' => DefaultStatus::class
    ];

    public function scopePublished($query){
        $query->where('status', DefaultStatus::Published);
    }
}
