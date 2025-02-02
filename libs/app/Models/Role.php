<?php

namespace App\Models\Role;

use App\Traits\LoggableRelations;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    use LoggableRelations;
    
    protected $logRelations = [
        'user' => ['id', 'name'],
        'category' => ['id', 'name', 'slug'],
        'manufacturer' => ['id', 'name', 'slug'],
        'attributes' => ['id', 'name', 'pivot' => ['value', 'highlight']],
        'filters' => ['id', 'name'],
        'categories' => ['id', 'name', 'slug'],
        'images' => ['id', 'image', 'alt'],
        'warranties' => ['id', 'name', 'slug'],
        'relatedProducts' => ['id', 'name', 'slug'],
        'crossProducts' => ['id', 'name', 'slug'],
    ];
    
    protected $logOnly = [
        'name',
        'display_name',
        'content',
        'is_deletable',
    ];
    
    protected $translations = [
        'id' => 'آی دی',
        'name' => 'نام',
        'display_name' => 'نام نمایشی',
        'is_deletable' => 'قابل حذف',
    ];
    
    protected $type = [
        'name' => 'string',
        'display_name' => 'string',
        'slug' => 'string',
        'is_deletable' => 'boolean',
    ];
}