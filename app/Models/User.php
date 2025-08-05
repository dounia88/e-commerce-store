<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if user is vendor/seller
     */
    public function isVendor(): bool
    {
        return $this->hasRole('seller') || $this->hasRole('vendor');
    }

    /**
     * Check if user is client
     */
    public function isClient(): bool
    {
        return $this->hasRole('client');
    }

    /**
     * Get cart items count for the user
     */
    public function getCartItemsCountAttribute(): int
    {
        if (class_exists(\App\Models\Cart::class)) {
            return $this->hasMany(\App\Models\Cart::class)->sum('quantity') ?? 0;
        }
        return 0;
    }

    /**
     * Relation avec le panier
     */
    public function cartItems()
    {
        if (class_exists(\App\Models\Cart::class)) {
            return $this->hasMany(\App\Models\Cart::class);
        }
        return collect();
    }
}
