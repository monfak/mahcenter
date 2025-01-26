<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title',
        'user_id',
        'ip',
        'product_id',
        'status',
    ];
    
    protected $casts = [
        'status' => 'boolean',
    ];
    
    protected $dates = [
        'published_at',
    ];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function getAvatarAttribute()
    {
        return 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '?s=45';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
