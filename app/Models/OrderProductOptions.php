<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProductOptions extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'order_product_id',
        'option',
        'value',
        'quantity',
        'price',
        'discount',
        'total_price',
    ];

    public function orderProduct()
    {
        return $this->belongsTo(OrderProducts::class);
    }
}
