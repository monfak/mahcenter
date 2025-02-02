<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use LoggableRelations;
    
    protected $fillable = ['alt', 'heading', 'url', 'image', 'sort_order', 'is_active'];
    
    protected $logRelations = [];
    
    protected $logOnly = [
        'alt',
        'heading',
        'url',
        'image',
        'sort_order',
        'is_active',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'alt' => 'متن جایگزین تصویر',
        'heading' => 'عنوان',
        'url' => 'لینک',
        'image' => 'تصویر',
        'sort_order' => 'ترتیب',
        'is_active' => 'وضعیت',
    ];
    
    protected $type = [
        'alt' => 'string',
        'url' => 'string',
        'heading' => 'string',
        'image' => 'تصویر',
        'sort_order' => 'ترتیب',
        'is_active' => 'وضعیت',
    ];
	
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
