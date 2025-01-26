<?php

namespace App\Models;

use App\Observers\PageObserver;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([PageObserver::class])]
class Page extends Model
{
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
