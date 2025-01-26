<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallmentApplication extends Model
{
    protected $fillable = ['name', 'mobile', 'plan_id', 'content', 'seen_at'];
    
    protected $dates = ['seen_at'];
    
    public function plan()
    {
        return $this->belongsTo(InstallmentPlan::class);
    }
    
    /**
     * Scope a query to only include unseen messages.
     *
     * @param $query
     * @return mixed
     */
    public function scopeUnseen($query): mixed
    {   
        return $query->whereNull('seen_at');
    }
}
