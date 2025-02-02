<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    use LoggableRelations;
    
    protected $fillable = [
        'name',
        'price',
        'content',
        'has_carrige_forward',
        'in_city_price',
        'small_floor_price',
        'big_floor_price',
        'is_cover_all',
        'is_active',
    ];
    
    protected $logRelations = [];
    
    protected $logOnly = [
        'name',
        'content',
        'price',
        'has_carrige_forward',
        'in_city_price',
        'small_floor_price',
        'big_floor_price',
        'is_cover_all',
        'is_active',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'name' => 'نام',
        'content' => 'محتوا',
        'price' => 'هزینه',
        'has_carrige_forward' => 'پس کرایه',
        'in_city_price' => 'هزینه درون شهری',
        'small_floor_price' => 'هزینه طبقه خورده ریز',
        'big_floor_price' => 'هزینه طبقه درشت',
        'is_cover_all' => 'پوشش کلی',
        'is_active' => 'وضعیت',
    ];
    
    protected $type = [
        'name' => 'string',
        'content' => 'string',
        'price' => 'price',
        'has_carrige_forward' => 'boolean',
        'in_city_price' => 'price',
        'small_floor_price' => 'price',
        'big_floor_price' => 'price',
        'is_cover_all' => 'boolean',
        'is_active' => 'boolean',
    ];
    
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_cover_all' => 'boolean',
            'has_carrige_forward' => 'boolean',
        ];
    }
    
    public function scopeActive($query)
    {
        return $this->where('is_active', true);
    }
}
