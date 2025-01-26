<?php

namespace App\Repositories;

use App\Models\BannerItem;
use App\Repositories\Contracts\BannerItemRepositoryInterface;

class BannerItemRepository extends BaseRepository implements BannerItemRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return BannerItem::class;
    }
}
