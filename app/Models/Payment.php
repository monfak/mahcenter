<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const STATUS_UNPAID = false;
    const STATUS_PAID   = true;

    protected $fillable = [
        'order_id',
        'user_id',
        'amount',
        'tracking_code',
        'ref_id',
        'method',
        'status',
        'port',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function scopeUnpaid($query)
    {
        return $query->whereStatus(self::STATUS_UNPAID);
    }

    public function scopePaid($query)
    {
        return $query->whereStatus(self::STATUS_PAID);
    }
}
