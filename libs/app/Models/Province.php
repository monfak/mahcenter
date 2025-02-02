<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use LoggableRelations;
    
    protected $fillable = ['name', 'price_large', 'price_small'];
    
    protected $logRelations = [];
    
    protected $logOnly = [
        'name',
        'price_large',
        'price_small',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'name' => 'نام',
        'price_large' => 'هزینه درشت',
        'price_small' => 'هزینه خرده ریز',
    ];
    
    protected $type = [
        'name' => 'string',
        'price_large' => 'price',
        'price_small' => 'price',
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
