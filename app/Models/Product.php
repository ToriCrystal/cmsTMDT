<?php

namespace App\Models;

use App\Enums\DefaultStatus;
use App\Enums\Product\StockStatus;
use App\Supports\Eloquent\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Sluggable;
    protected $table = 'products';
    protected $columnSlug = 'name';

    protected $guarded = [];

    protected $fillable = [
        'store_id',
        'category_id',
        'name',
        'slug',
        'price',
        'price_selling',
        'price_promotion',
        'sku',
        'manage_stock',
        'qty',
        'in_stock',
        'status',
        'feature_image',
        'gallery',
        'status',
        'short_desc',
        'longitude',
        'latitude',
        'desc',
        'viewed',
    ];
    protected $casts = [
        'in_stock' => StockStatus::class,
        'status' => DefaultStatus::class,
    ];
    public function scopePublished($query)
    {
        return $query->where('status', DefaultStatus::Published);
    }
    public function store()
    {
        return $this->belongsTo(Store::class,'store_id');
    }
    public function category()
    {
        return $this->belongsTo(StoreCategory::class, 'category_id');
    }
}
