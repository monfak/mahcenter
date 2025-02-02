<?php

namespace App\Traits;

trait LoggableRelations
{
    public function getLabel(string $field): string
    {
        return $this->translations[$field] ?? $field;
    }
    
    public function getLogRelations(): array
    {
        return $this->logRelations;
    }
    
    public function getLogRelation(string $relation): ?array
    {
        return $this->logRelations[$relation] ?? null;
    }

    public function getLogOnly(): array
    {
        return $this->logOnly;
    }
    
    public function getFieldType(string $field): string
    {
        return $this->type[$field] ?? 'string';
    }
    
    public function scopeLoadLogRelations($query)
    {
        return $query->with($this->logRelations ?? []);
    }
}