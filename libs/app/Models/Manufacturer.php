<?php

namespace App\Models;

use App\Observers\ManufacturerObserver;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([ManufacturerObserver::class])]
class Manufacturer extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'description',
        'title',
        'meta_description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'canonical',
        'is_nofollow',
        'is_noindex',
        'total_products',
    ];
    
    public function casts()
    {
        return [
            'is_nofollow' => 'boolean',
            'is_noindex' => 'boolean',
        ];
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function scopeIndex($query)
    {
        return $query->where('is_noindex', false);
    }

    public function scopeNoIndex($query)
    {
        return $query->where('is_noindex', true);
    }

    public function scopeFollow($query)
    {
        return $query->where('is_nofollow', false);
    }

    public function scopeNoFollow($query)
    {
        return $query->where('is_nofollow', true);
    }
}
