<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AttributeGroups extends Model
{
    protected $fillable = ['name', 'sort_order'];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderByRaw('ISNULL(sort_order), sort_order ASC');
        });
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'group_id');
    }
    
    public function category()
    {
        return $this->belongsToMany(Category::class, 'attribute_group_category', 'attribute_group_id', 'category_id');
    }
}
