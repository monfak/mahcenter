<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $fillable = ['old', 'url', 'type'];

    protected $casts = [
        'type' => 'integer',
    ];
}
