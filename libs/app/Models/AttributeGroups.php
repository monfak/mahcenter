<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AttributeGroups extends Model
{
    use LoggableRelations;
    
    protected $fillable = ['name', 'sort_order'];

    public $timestamps = false;
    
    protected $logRelations = [
        'attributes' => ['id', 'name', 'sort_order'],
    ];
    
    protected $logOnly = [
        'name',
        'sort_order',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'name' => 'نام',
        'sort_order' => 'ترتیب',
        'attributes' => 'خصوصیات',
    ];
    
    protected $type = [
        'name' => 'string',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderByRaw('ISNULL(sort_order), sort_order DESC');
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
