<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Model;

class InstallmentPlan extends Model
{
    use LoggableRelations;
    
    protected $fillable = ['name', 'sort_order', 'is_active'];
    
    protected $logRelations = [];
    
    protected $logOnly = [
        'name',
        'sort_order',
        'is_active',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'name' => 'نام',
        'sort_order' => 'ترتیب',
        'is_active' => 'وضعیت',
    ];
    
    protected $type = [
        'name' => 'string',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
