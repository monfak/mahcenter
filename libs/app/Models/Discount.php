<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    const TYPE_ALL            = 0;
    const TYPE_PRODUCT        = 1;
    const TYPE_CATEGORY       = 2;
    const TYPE_MANUFACTURER   = 3;

    protected $guarded = ['id'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function activeProducts()
    {
        return $this->belongsToMany(Product::class)->where('status', true);
    }

    public function codes()
    {
        return $this->hasMany(Code::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
