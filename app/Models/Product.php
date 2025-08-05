<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'original_price',
        'image',
        'stock',
        'category_id',
        'sku',
        'specifications',
        'is_featured',
        'is_active'
    ];

    protected $casts = [
        'specifications' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_products')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->original_price && $this->original_price > $this->price) {
            return round((($this->original_price - $this->price) / $this->original_price) * 100);
        }
        return 0;
    }

    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    public function getFormattedOriginalPriceAttribute()
    {
        return $this->original_price ? '$' . number_format($this->original_price, 2) : null;
    }
}
