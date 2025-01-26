<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    const STATUS_EXPIRED    = 0;
    const STATUS_PENDING    = 1;
    const STATUS_SENDING    = 2;
    const STATUS_SENT       = 3;
    const STATUS_RETURNED   = 4;
    const STATUS_COMPLETED  = 5;
    const PAY_ONLINE        = false;
    const CASH_ON_DELIVARY  = true;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address_id',
        'tracking_code',
        'mobile',
        'product_total',
        'discount',
        'total',
        'description',
        'user_ip',
        'user_agent',
        'cash_on_delivery',
        'discount_details',
        'status',
        'products_total_price',
        'total_price',
        'first_name',
        'last_name',
        'name',
        'is_sale_calculated',
        'is_guest',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function manufacturers()
    {
        return $this->belongsToMany(Manufacturer::class);
    }
    
    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot('quantity', 'price', 'discount', 'total_price','discount_details', 'warranty_id');
    }

    public function addresses()
    {
        return $this->morphToMany(Address::class, 'addressable');
    }

    public function latestAddress()
    {
        return $this->addresses()->get()->last();
    }

    public function hasAddress()
    {
        return $this->latestAddress() ? true : false;
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function reviews()
    {
        return $this->hasOne(OrderReviews::class);
    }

    public function scopeLastDays($query, $days)
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays($days));
    }

    public function scopeExpired($query)
    {
        return $query->whereStatus(self::STATUS_EXPIRED);
    }

    public function scopePending($query)
    {
        return $query->whereStatus(self::STATUS_PENDING);
    }

    public function scopeSending($query)
    {
        return $query->whereStatus(self::STATUS_SENDING);
    }

    public function scopeSent($query)
    {
        return $query->whereStatus(self::STATUS_SENT);
    }

    public function scopeReturned($query)
    {
        return $query->whereStatus(self::STATUS_RETURNED);
    }

    public function scopeCompleted($query)
    {
        return $query->whereStatus(self::STATUS_COMPLETED);
    }

    public function scopeUnchecked($query)
    {
        return $query->where('checked', false);
    }

    public function scopeChecked($query)
    {
        return $query->where('checked', true);
    }
    
    public function scopeNOtCalculated($query)
    {
        return $query->where('is_sale_calculated', false);
    }

    public function sadadPayments()
    {
        return $this->morphMany(PaymentSadad::class, 'paymentable');
    }

}
