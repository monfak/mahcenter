<?php

namespace App\Models;

use App\Observers\WarrantyObserver;
use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([WarrantyObserver::class])]
class Warranty extends Model
{
    use LoggableRelations;
    
    protected $fillable = [
        'name',
        'slug',
        'image',
        'logo',
        'content',
        'title',
        'description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'canonical',
        'is_nofollow',
        'is_noindex',
        'price',
        'is_active',
        'show_in_home',
    ];
    
    protected $type = [
        'name' => 'string',
        'slug' => 'string',
        'image' => 'image',
        'logo' => 'image',
        'content' => 'string',
        'description' => 'string',
        'title' => 'string',
        'og_image' => 'string',
        'twitter_title' => 'string',
        'twitter_description' => 'string',
        'twitter_image' => 'image',
        'canonical' => 'string',
        'is_nofollow' => 'boolean',
        'is_noindex' => 'boolean',
        'price' => 'price',
        'is_active' => 'boolean',
        'show_in_home' => 'boolean',
    ];
    
    protected $logRelations = [];
    
    protected $logOnly = [
        'name',
        'slug',
        'image',
        'logo',
        'content',
        'title',
        'description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'canonical',
        'is_nofollow',
        'is_noindex',
        'price',
        'is_active',
        'show_in_home',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'name' => 'نام',
        'slug' => 'اسلاگ',
        'image' => 'تصویر شاخص',
        'logo' => 'لوگو',
        'content' => 'محتوا',
        'title' => 'تایتل',
        'description' => 'دسکریپشن',
        'og_image' => 'تصویر اپن گراف',
        'twitter_title' => 'تایتل توئیتر',
        'twitter_description' => 'دسکریپشن توئیتر',
        'twitter_image' => 'تصویر توئیتر',
        'canonical' => 'کنونیکال',
        'is_nofollow' => 'نوفالو است',
        'is_noindex' => 'نوایندکس است',
        'price' => 'هزینه',
        'is_active' => 'فعال است؟',
        'show_in_home' => 'نمایش در صفحه اصلی',
    ];
    
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_nofollow' => 'boolean',
            'is_noindex' => 'boolean',
            'show_in_home' => 'boolean',
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function scopeActive($query)
    {
        return $this->where('is_active', true);
    }
    
    public function scopePublished($query)
    {
        return $this->where('is_active', true);
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
    
    public function scopeInhome($query)
    {
        return $query->where('show_in_home', true);
    }
}
