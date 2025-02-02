<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use LoggableRelations;
    
    protected $fillable = ['name', 'province_id', 'price_large', 'price_small'];
    
    protected $logRelations = [
        'province' => ['id', 'name'],
    ];
    
    protected $logOnly = [
        'name',
        'province_id',
        'price_large',
        'price_small',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'name' => 'نام',
        'province_id' => 'استان',
        'price_large' => 'هزینه درشت',
        'price_small' => 'هزینه خرده ریز',
    ];
    
    protected $type = [
        'name' => 'string',
        'province_id' => 'relation',
        'price_large' => 'price',
        'price_small' => 'price',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
