<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryDate extends Model
{
    protected $fillable = ['lead_date'];

    public function cities()
    {
        return $this->belongsToMany(City::class);
    }
}
