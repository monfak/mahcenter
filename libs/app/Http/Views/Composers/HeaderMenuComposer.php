<?php

namespace App\Http\Views\Composers;

use App\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class HeaderMenuComposer
{
    public function compose(View $view)
    {
        $headerMenu = Cache::remember('header-menu', now()->addMinutes(5), function() {
            return Menu::with(['items' => function($query){
                $query->active();
            }])->inPosition('header')->first();
        });
        $view->with('headerMenu', $headerMenu);
    }
}
