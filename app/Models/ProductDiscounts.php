<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDiscounts extends Model
{
    protected $fillable = [];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
