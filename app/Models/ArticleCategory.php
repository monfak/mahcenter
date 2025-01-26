<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
        'slug',
        'image',
        'meta_keywords',
        'meta_description',
        'description'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }


    public function children()
    {
        return $this->hasMany(ArticleCategory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(ArticleCategory::class, 'parent_id');
    }

}
