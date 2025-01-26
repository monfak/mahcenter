<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['heading', 'sort_order', 'content', 'is_active', 'is_before_b2b', 'is_after_b2b'];
    
    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
        'is_before_b2b' => 'boolean',
        'is_after_b2b' => 'boolean',
    ];
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('sorted', function (Builder $builder) {
            $builder->latest('sort_order');
        });
    }
    
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    public function scopeBeforeB2b($query)
    {
        return $query->where('is_before_b2b', true);
    }
    
    public function scopeAfterB2b($query)
    {
        return $query->where('is_after_b2b', true);
    }
}
