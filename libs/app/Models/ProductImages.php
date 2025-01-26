<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $fillable = ['image', 'sort_order', 'alt'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
