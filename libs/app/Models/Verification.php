<?php

namespace App\Models;

use App\Interfaces\Security;
use App\Traits\Security as SecurityTrait;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model implements Security
{
    use SecurityTrait;

    protected $fillable = [
        'mobile',
        'otp',
        'is_used',
    ];
    
    protected $casts = [
        'is_used' => 'boolean',
    ];

    public function __construct(array $attributes = [])
    {
        if (!isset($attributes['otp'])) {
            $attributes['otp'] = static::generateCode();
        }

        parent::__construct($attributes);
    }
    
    public function scopeValid($query)
    {
        return $query->where('is_used', false)
            ->where('created_at', '>=', now()->subSeconds(180));
    }

    public function scopeWaiting($query)
    {
        return $query->where('created_at', '>=', now()->subSeconds(180));
    }

    public function scopeUsed($query)
    {
        return $query->where('is_used', true);
    }

    public function scopeUnused($query)
    {
        return $query->where('is_used', false);
    }
}
