<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BannerItem extends Model
{
    protected $fillable = ['title', 'banner_id', 'url', 'image', 'content', 'sort_order', 'webp',];

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

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }
}
