<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallmentPlan extends Model
{
    protected $fillable = ['name', 'sort_order', 'is_active'];
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
