<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['value'];
    
    public function scopeAutoload($query)
    {
        return $this->where('autoload', true);
    }
}
