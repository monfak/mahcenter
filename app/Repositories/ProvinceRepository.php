<?php

namespace App\Repositories;

use App\Models\Province;
use App\Repositories\Contracts\ProvinceRepositoryInterface;
use Illuminate\Http\Request;

class ProvinceRepository extends BaseRepository implements ProvinceRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return Province::class;
    }
}
