<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use App\Observers\ArticleObserver;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([ArticleObserver::class])]
class Article extends Model
{
    use LoggableRelations;
    
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'content',
        'category_id',
        'meta_keywords',
        'meta_description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'canonical',
        'is_nofollow',
        'is_noindex',
        'reading_time',
        'is_suggested',
        'status',
        'top_product_id',
        'middle_product_id',
        'bottom_product_id',
    ];
    
    protected $logRelations = [
        'user' => ['id', 'name'],
        'category' => ['id', 'name', 'slug'],
        'faqs' => ['id', 'name'],
        'products' => ['id', 'name', 'slug'],
        'relates' => ['id', 'title', 'slug'],
    ];
    
    protected $logOnly = [
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
        'is_suggested',
        'status',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'title' => 'تایتل',
        'slug' => 'اسلاگ',
        'image' => 'تصویر شاخص',
        'content' => 'محتوا',
        'meta_keywords' => 'متاکیوردز',
        'meta_description' => 'متادسکریپشن',
        'og_image' => 'تصویر اپن گراف',
        'twitter_title' => 'تایتل توئیتر',
        'twitter_description' => 'دسکریپشن توئیتر',
        'twitter_image' => 'تصویر توئیتر',
        'canonical' => 'کنونیکال',
        'is_nofollow' => 'نوفالو است',
        'is_noindex' => 'نوایندکس است',
        'is_suggested' => 'پیشنهاد سردبیر',
        'status' => 'وضعیت انتشار',
        'user' => 'نویسنده',
        'category' => 'دسته بندی',
        'faqs' => 'سوالات متداول',
        'products' => 'محصولات مرتبط',
        'relates' => 'مقالات مرتبط',
        
    ];
    
    protected $type = [
        'user_id' => 'relation',
        'title' => 'string',
        'slug' => 'string',
        'image' => 'image',
        'content' => 'string',
        'category_id' => 'relation',
        'meta_keywords' => 'string',
        'meta_description' => 'string',
        'og_image' => 'image',
        'twitter_title' => 'string',
        'twitter_description' => 'string',
        'twitter_image' => 'image',
        'canonical' => 'string',
        'is_nofollow' => 'boolean',
        'is_noindex' => 'boolean',
        'is_suggested' => 'boolean',
        'status' => 'boolean',
        'top_product_id' => 'relation',
        'middle_product_id' => 'relation',
        'bottom_product_id' => 'relation',
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

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class);
    }
    
    public function faqs()
    {
        return $this->belongsToMany(Faq::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    
    public function relates()
    {
        return $this->belongsToMany(Article::class, 'related_article', 'article_id', 'related_id');
    }
    
    public function scopeSuggested($query)
    {
        return $this->where('is_suggested', true);
    }

    public function scopePublished($query)
    {
        return $this->where('status', true);
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
