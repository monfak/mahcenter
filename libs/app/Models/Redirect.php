<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    use LoggableRelations;
    
    protected $fillable = ['old', 'url', 'type'];
    
    protected $logRelations = [];
    
    protected $logOnly = [
        'old',
        'url',
        'type',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'old' => 'لینک قدیم',
        'url' => 'لینک جدید',
        'type' => 'نوع انتقال',
    ];
    
    protected $type = [
        'old' => 'string',
        'url' => 'string',
        'type' => 'integer',
    ];

    protected $casts = [
        'type' => 'integer',
    ];
}
