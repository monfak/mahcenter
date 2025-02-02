<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use LoggableRelations;
    
    protected $fillable = ['heading', 'sort_order', 'content', 'is_active', 'is_before_b2b', 'is_after_b2b'];
    
    protected $logRelations = [];
    
    protected $logOnly = [
        'heading', 'sort_order', 'content', 'is_active', 'is_before_b2b', 'is_after_b2b',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'heading' => 'عنوان',
        'sort_order' => 'ترتیب',
        'content' => 'محتوا',
        'is_active' => 'فعال است؟',
        'is_before_b2b' => 'قبل از خرید عمده',
        'is_after_b2b' => 'بعد از خرید عمده',
    ];
    
    protected $type = [
        'heading' => 'string',
        'sort_order' => 'integer',
        'content' => 'string',
        'is_active' => 'boolean',
        'is_before_b2b' => 'boolean',
        'is_after_b2b' => 'boolean',
    ];
    
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
