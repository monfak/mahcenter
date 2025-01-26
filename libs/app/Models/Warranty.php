<?php

namespace App\Models;

use App\Observers\WarrantyObserver;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([WarrantyObserver::class])]
class Warranty extends Model
{
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
