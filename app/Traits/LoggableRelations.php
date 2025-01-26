<?php

namespace App\Traits;

trait LoggableRelations
{
    public function scopeLoadLogRelations($query)
    {
        return $query->with($this->logRelations ?? []);
    }
}