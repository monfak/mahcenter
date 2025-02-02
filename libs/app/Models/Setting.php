<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use LoggableRelations;
    
    protected $fillable = ['value'];
    
    protected $logRelations = [];
    
    protected $logOnly = [
        'key',
        'label',
        'value',
        'autoload',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'key' => 'کلید',
        'label' => 'لیبل',
        'value' => 'مقدار',
        'autoload' => 'لود خودکار',
    ];
    
    protected $type = [
        'key' => 'string',
        'label' => 'string',
        'value' => 'string',
        'autoload' => 'boolean',
    ];
    
    public function scopeAutoload($query)
    {
        return $this->where('autoload', true);
    }
}
