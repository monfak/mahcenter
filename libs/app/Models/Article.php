<?php

namespace App\Models;

use App\Observers\ArticleObserver;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([ArticleObserver::class])]
class Article extends Model
{
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
