<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Contracts\CityRepositoryInterface;
use Illuminate\Http\Request;

class CityRepository extends BaseRepository implements CityRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return City::class;
    }

    /**
     * @param int $cityId
     * @return int
     */
    public function getProvinceId(int $cityId): int
    {
        $city = $this->getModel()->query()->find($cityId);
        return $city->province_id;
    }
}
