<?php

namespace App\Models;

use App\Observers\ManufacturerObserver;
use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([ManufacturerObserver::class])]
class Manufacturer extends Model
{
    use LoggableRelations;
    
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
    
    protected $logRelations = [];
    
    protected $logOnly = [
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
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'name' => 'نام',
        'slug' => 'اسلاگ',
        'logo' => 'لوگو',
        'description' => 'محتوا',
        'title' => 'تایتل',
        'meta_description' => 'متادسکریپشن',
        'og_image' => 'تصویر اپن گراف',
        'twitter_title' => 'تایتل توئیتر',
        'twitter_description' => 'دسکریپشن توئیتر',
        'twitter_image' => 'تصویر توئیتر',
        'canonical' => 'کنونیکال',
        'is_nofollow' => 'نوفالو است',
        'is_noindex' => 'نوایندکس است',
    ];
    
    protected $type = [
        'name' => 'string',
        'slug' => 'string',
        'logo' => 'image',
        'description' => 'string',
        'title' => 'string',
        'meta_description' => 'string',
        'og_image' => 'image',
        'twitter_title' => 'string',
        'twitter_description' => 'string',
        'twitter_image' => 'string',
        'canonical' => 'string',
        'is_nofollow' => 'boolean',
        'is_noindex' => 'boolean',
        'total_products' => 'integer',
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
