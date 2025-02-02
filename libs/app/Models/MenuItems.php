<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
    use LoggableRelations;
    
    public const STATUS_DRAFT       = false;
    public const STATUS_PUBLISHED   = true;

    protected $fillable = [
        'heading',
        'menu_id',
        'label',
        'url',
        'image',
        'parent_id',
        'sort_order',
        'is_active',
    ];
    
    protected $logRelations = [
        'parent' => ['id', 'name'],
    ];
    
    protected $logOnly = [
        'heading',
        'menu_id',
        'label',
        'url',
        'image',
        'parent_id',
        'sort_order',
        'is_active',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'heading' => 'عنوان',
        'menu_id' => 'منو',
        'label' => 'لیبل',
        'url' => 'لینک',
        'image' => 'تصویر',
        'parent_id' => 'والد',
        'sort_order' => 'ترتیب',
        'is_active' => 'وضعیت',
    ];
    
    protected $type = [
        'heading' => 'string',
        'menu_id' => 'relation',
        'label' => 'string',
        'url' => 'string',
        'image' => 'image',
        'parent_id' => 'relation',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that should be casted to native types.
     * @var array
     */
    protected $casts = [
        'sort_order' => 'integer',
        'is_active'  => 'boolean',
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

    public function scopeDraft($query)
    {
        return $query->where('is_active', self::STATUS_DRAFT);
    }

    public function scopePublished($query)
    {
        return $query->where('is_active', self::STATUS_PUBLISHED);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', self::STATUS_PUBLISHED);
    }

    public function scopeMain($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeHasParent($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function scopeHasChildren($query)
    {
        return $query->children()->exists();
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function children()
    {
        return $this->hasMany(MenuItems::class, 'parent_id')->oldest('sort_order');
    }

    public function parent()
    {
        return $this->belongsTo(MenuItems::class, 'parent_id')->oldest('sort_order');
    }

    public function activeChildren()
    {
        return $this->children()->published();
    }

    public function activeParent()
    {
        return $this->parent()->active();
    }
}
