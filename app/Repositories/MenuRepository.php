<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Repositories\Contracts\MenuRepositoryInterface;
use Illuminate\Http\Request;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return Menu::class;
    }

    public function getHeaderWithItems()
    {
        return Menu::query()->with(['items' => function($query) {
            $query->with(['children' => function($query) {
                $query->with(['children' => function($query) {
                    $query->active();
                }])->active();
            }])->main()->active();
        }])->inPosition('header')->active()->first();
    }
}
