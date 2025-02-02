<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use LoggableRelations;
    
    public const STATUS_DRAFT       = false;
    public const STATUS_PUBLISHED   = true;

    protected $fillable = [
        'name',
        'position',
        'is_active',
    ];
    
    protected $logRelations = [
        'items' => ['id', 'parent_id', 'heading', 'label', 'url', 'image', 'sort_order', 'is_active'],
    ];
    
    protected $logOnly = [
        'name',
        'position',
        'is_active',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'name' => 'نام',
        'position' => 'موقعیت',
        'is_active' => 'وضعیت',
    ];
    
    protected $type = [
        'name' => 'string',
        'position' => 'string',
        'is_active' => 'boolean',
        'items' => 'relation',
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
