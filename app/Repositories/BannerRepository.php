<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Repositories\Contracts\BannerRepositoryInterface;
use Illuminate\Http\Request;

class BannerRepository extends BaseRepository implements BannerRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return Banner::class;
    }

    public function getPartners()
    {
        return Banner::query()->with('items.image')->inPosition('partner')->active()->first();
    }
}
