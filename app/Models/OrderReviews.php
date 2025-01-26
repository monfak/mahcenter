<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderReviews extends Model
{
    protected $fillable = ['user_id', 'order_id', 'content', 'star', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
