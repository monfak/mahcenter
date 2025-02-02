<?php

namespace App\Models;

use App\Traits\LoggableRelations;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use LoggableRelations;
    
    protected $fillable = ['name'];
    
    protected $logRelations = [];
    
    protected $logOnly = ['name'];
    
    protected $translations = [
        'id' => 'آی دی',
        'name' => 'نام',
    ];
    
    protected $type = [
        'name' => 'string',
    ];

    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
