<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = ['alt', 'heading', 'url', 'image', 'sort_order', 'is_active'];
	
	protected $casts = [
	    'sort_order' => 'integer',
	    'status' => 'boolean',
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
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
