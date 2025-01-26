<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    const TRASHED = 0;
    const PENDING = 1;
    const REJECTED = 2;
    const APPROVED = 3;
    
    protected $fillable = [
        'content',
        'user_id',
        'name',
        'ip',
        'email',
        'article_id',
        'parent_id',
        'status',
        'seen_at',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
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
     * Scope a query to only include unseen comments.
     *
     * @param $query
     * @return mixed
     */
    public function scopeUnseen($query): mixed
    {   
        return $query->whereNull('seen_at');
    }
    
    public function scopeApproved($query)
    {
        return $query->where('status', self::APPROVED);
    }
}
