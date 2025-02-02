<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Model;

class InstallmentPercent extends Model
{
    use LoggableRelations;
    
    protected $table = "installment_percent";
    
    protected $fillable = ['percent', 'is_active'];
    
    protected $logRelations = [];
    
    protected $logOnly = [
        'percent',
        'is_active',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'percent' => 'درصد',
        'is_active' => 'وضعیت',
    ];
    
    protected $type = [
        'percent' => 'integer',
        'is_active' => 'boolean',
    ];
}
