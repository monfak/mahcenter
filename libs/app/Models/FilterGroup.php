<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FilterGroup extends Model
{
    use LoggableRelations;
    
    protected $fillable = ['name', 'label', 'sort_order'];

    protected $appends = ['nameLabel'];

    public $timestamps = false;
    
    protected $logRelations = [
        'filters' => ['id', 'name', 'sort_order'],
    ];
    
    protected $logOnly = [
        'name',
        'label',
        'sort_order',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'name' => 'نام',
        'label' => 'لیبل',
        'sort_order' => 'ترتیب',
    ];
    
    protected $type = [
        'name' => 'string',
        'label' => 'string',
        'sort_order' => 'integer',
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
            $builder->oldest('sort_order');
        });
    }

    public function filters()
    {
        return $this->hasMany(Filter::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the filter's name along with its label.
     *
     * @return string
     */
    public function getNameLabelAttribute()
    {
        return $this->name . (!is_null($this->label) ? ' (' . $this->label . ')' : '');
    }
}
