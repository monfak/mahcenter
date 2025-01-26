<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Banner extends Model
{
    protected $fillable = ['name', 'status', 'position', 'width', 'height'];

    public function items()
    {
        return $this->hasMany(BannerItem::class);
    }

    public function orderedItems()
    {
        return $this->hasMany(BannerItem::class)->orderBy('sort_order', 'asc');
    }

    /**
     * Retrieves the specific banners with sorted items.
     *
     * @param $position
     * @return mixed
     */
    public static function getBanner($position)
    {
        return static::with('orderedItems')->where(['position' => $position, 'status' => 1])->get()->first();
    }

    /**
     * Retrieves the specific banners with sorted items.
     *
     * @param array $positions
     * @return mixed
     */
    public static function getBanners(array $positions)
    {
        return static::with('orderedItems')->whereIn('position', $positions)->where('status', 1)->get();
    }

    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }


    /**
     * Scope a query to include banners with a specific position.
     *
     * @param Builder $query
     * @param string $position
     * @return Builder
     */
    public function scopeInPosition(Builder $query, string $position): Builder
    {
        return $query->wherePosition($position);
    }

    /**
     * Scope a query to include banners with positions from a given list.
     *
     * @param Builder $query
     * @param array $positions
     * @return Builder
     */
    public function scopeInPositions(Builder $query, array $positions): Builder
    {
        return $query->whereIn('position', $positions);
    }
}
