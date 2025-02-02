<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use LoggableRelations;
    
    protected $fillable = ['name', 'city_id', 'price_large', 'price_small'];
    
    protected $logRelations = [
        'city' => ['id', 'name'],
    ];
    
    protected $logOnly = [
        'name',
        'city_id',
        'price_large',
        'price_small',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'name' => 'نام',
        'city_id' => 'شهر',
        'price_large' => 'هزینه درشت',
        'price_small' => 'هزینه خرده ریز',
    ];
    
    protected $type = [
        'name' => 'string',
        'city_id' => 'relation',
        'price_large' => 'price',
        'price_small' => 'price',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
