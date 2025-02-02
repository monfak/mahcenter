<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Model;

class InstallmentMonth extends Model
{
    use LoggableRelations;
    
    protected $table = "installment_month";
    protected $fillable = ['month', 'is_active'];
    
    protected $logRelations = [];
    
    protected $logOnly = [
        'month',
        'is_active',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'month' => 'نام',
        'is_active' => 'وضعیت',
    ];
    
    protected $type = [
        'month' => 'integer',
        'is_active' => 'boolean',
    ];
}
