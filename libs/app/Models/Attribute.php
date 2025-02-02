<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Attribute extends Model
{
    protected $fillable = ['group_id', 'name', 'sort_order'];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderByRaw('ISNULL(sort_order), sort_order DESC');
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function group()
    {
        return $this->belongsTo(AttributeGroups::class);
    }
}
