<?php

namespace App\Repositories\Contracts;

interface CityRepositoryInterface extends BaseRepositoryInterface
{
    public function getProvinceId(int $cityId);
}
