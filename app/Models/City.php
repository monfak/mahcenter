<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'province_id', 'price_large', 'price_small'];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
