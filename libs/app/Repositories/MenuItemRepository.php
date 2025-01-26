<?php

namespace App\Repositories;

use App\Models\MenuItem;
use App\Repositories\Contracts\MenuItemRepositoryInterface;

class MenuItemRepository extends BaseRepository implements MenuItemRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return MenuItem::class;
    }
}
