<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', 'last_name', 'name', 'email', 'mobile', 'national_cart', 'reject', 'password','mobile_verification_code','national_code',
        'mobile_verified_at', 'two_factor_activated', 'two_factor_verified_at', 'active', 'all_categories'
    ];

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'national_cart' => 'array',
        ];
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function latestAddress()
    {
        return $this->addresses()->latest()->first();
    }

    public function hasAddress()
    {
        return $this->latestAddress() ? true : false;
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
    
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reviewedProducts()
    {
        return $this->belongsToMany(Product::class, 'reviews');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class)->whereNull('product_id');
    }

    public function productTickets()
    {
        return $this->hasMany(Ticket::class)->whereNotNull('product_id');
    }

    public function wishlist()
    {
        return $this->belongsToMany(Product::class, 'wishlist')->withPivot('is_notification');
    }

    public function wishlists()
    {
        return $this->belongsToMany(Product::class, 'wishlist')->wherePivot('is_notification', false);
    }

    public function notifications()
    {
        return $this->belongsToMany(Product::class, 'wishlist')->wherePivot('is_notification', true);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function orderReviews()
    {
        return $this->hasMany(OrderReviews::class);
    }

    public function twoFactorTokens()
    {
        return $this->hasMany(TwoFactor::class);
    }

    public function twoFactorCode()
    {
        return $this->twoFactorTokens()->latest()->first();
    }

    public function is_member_of_newsletter()
    {
        return Member::whereEmail($this->email)->first();
    }

    public function seller()
    {
        return $this->hasOne(Seller::class)->withDefault();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withTimestamps()
            ->withPivot('stock', 'price', 'special', 'special_started_at', 'special_ended_at', 'max_order', 'min_order', 'expiration_date',
                'discount', 'warranty', 'giftcard', 'active', 'commission_status', 'sending_time', 'admin_status', 'warehouse_id', 'special_without_limitation');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
}
