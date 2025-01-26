<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'warrany_id',
        'quantity',
        'price',
        'warranty_price',
        'discount',
        'discount_details',
        'total_price',
    ];

    public $timestamps = false;

    public function options()
    {
        return $this->hasMany(OrderProductOptions::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function warranty()
    {
        return $this->belongsTo(Warranty::class);
    }
}
