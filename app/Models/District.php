<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name', 'city_id', 'price_large', 'price_small'];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
