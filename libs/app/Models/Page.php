<?php

namespace App\Models;

use App\Observers\PageObserver;
use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([PageObserver::class])]
class Page extends Model
{
    use LoggableRelations;
    
    protected $fillable = [
        'user_id',
        'heading',
        'title',
        'slug',
        'image',
        'content',
        'meta_keywords',
        'meta_description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'canonical',
        'is_nofollow',
        'is_noindex',
        'status',
    ];
    
    protected $logRelations = [];
    
    protected $logOnly = [
        'heading',
        'title',
        'slug',
        'image',
        'content',
        'meta_keywords',
        'meta_description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'canonical',
        'is_nofollow',
        'is_noindex',
        'status',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'user_id' => 'کاربر',
        'heading' => 'عنوان',
        'slug' => 'اسلاگ',
        'image' => 'تصویر شاخص',
        'content' => 'محتوا',
        'status' => 'وضعیت',
        'title' => 'تایتل',
        'meta_keywords' => 'کلمات کلیدی',
        'meta_description' => 'دسکریپشن',
        'og_image' => 'عکس اپن گراف',
        'twitter_title' => 'تایتل توئیتر',
        'twitter_description' => 'دسکریپشن توئیتر',
        'twitter_image' => 'تصویر توئیتر',
        'canonical' => 'کنونیکال',
        'is_nofollow' => 'نوفالو',
        'is_noindex' => 'نوایندکس',
    ];
    
    protected $type = [
        'user_id',
        'heading',
        'slug',
        'image',
        'content',
        'status',
        'title' => 'string',
        'meta_keywords' => 'string',
        'meta_description' => 'string',
        'og_image' => 'string',
        'twitter_title' => 'string',
        'twitter_description' => 'string',
        'twitter_image' => 'image',
        'canonical' => 'string',
        'is_nofollow' => 'boolean',
        'is_noindex' => 'boolean',
        'status' => 'boolean',
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
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
    
    public function scopePublished($query)
    {
        return $query->where('status', true);
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
