<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
       protected $fillable = ['discount_id','code','used','user_id','consumer_id'];

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consumer()
    {
        return $this->belongsTo(User::class);
    }
}
