<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name', 'price_large', 'price_small'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
