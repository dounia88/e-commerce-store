<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'order_number',
        'stripe_payment_intent_id',
        'shipping_address',
        'billing_address',
        'notes'
    ];

    protected $casts = [
        'shipping_address' => 'array',
        'billing_address' => 'array',
        'total_price' => 'decimal:2'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    public function getFormattedTotalPriceAttribute()
    {
        return '$' . number_format($this->total_price, 2);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'processing' => 'bg-blue-100 text-blue-800',
            'shipped' => 'bg-purple-100 text-purple-800',
            'delivered' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800'
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }
}
