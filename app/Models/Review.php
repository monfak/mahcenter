<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'title',
        'content',
        'star',
        'user_id',
        'name',
        'ip',
        'email',
        'product_id',
        'parent_id',
        'status',
        'seen_at',
    ];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    public function children()
    {
        return $this->hasMany(Review::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Review::class, 'parent_id');
    }

    public function getAvatarAttribute()
    {
        return 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '?s=45';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Scope a query to only include unseen reviews.
     *
     * @param $query
     * @return mixed
     */
    public function scopeUnseen($query): mixed
    {   
        return $query->whereNull('seen_at');
    }
}
