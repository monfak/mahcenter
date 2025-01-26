<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterProduct extends Model
{
    protected $table = 'filter_product';

    protected $fillable = [
        'filter_id',
        'product_id',
    ];
}
