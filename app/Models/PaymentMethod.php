<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'driver',
        'name',
        'label',
        'is_active',
        'is_removable',
        'discount_percentage',
        'sort_order',
        'content',
    ];
    
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_removable' => 'boolean',
        ];
    }
    
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
        return $this->where('is_active', true);
    }
    
    public function scopeRemovable($query)
    {
        return $this->where('is_removable', true);
    }
}
