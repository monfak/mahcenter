<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'city_id',
        'address',
        'post_code',
        'deleted_at',
        'is_default',
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function users()
    {
        return $this->morphedByMany(User::class, 'addressable');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }
}
