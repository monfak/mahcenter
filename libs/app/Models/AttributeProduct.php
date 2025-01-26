<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeProduct extends Model
{
    protected $table = 'attribute_product';

    protected $fillable = [
        'attribute_id',
        'product_id',
        'highlight',
        'value',
    ];
}
