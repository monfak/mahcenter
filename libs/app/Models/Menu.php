<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public const STATUS_DRAFT       = false;
    public const STATUS_PUBLISHED   = true;

    protected $fillable = [
        'name',
        'position',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(MenuItems::class);
    }

    public function scopeDraft($query)
    {
        return $query->whereStatus(self::STATUS_DRAFT);
    }

    public function scopePublished($query)
    {
        return $query->whereStatus(self::STATUS_PUBLISHED);
    }

    public function scopeInPosition($query, $position)
    {
        return $query->wherePosition($position);
    }
    
    public function scopeInPositions($query, $positions)
    {
        return $query->whereIn('position', $positions)->oldest('position');
    }
}
