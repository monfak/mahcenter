<?php

namespace App\Http\Views\Composers;

use App\Models\Banner;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class PanelSidebarComposer
{
    public function compose(View $view)
    {
        $panelSidebar = Cache::remember('panel-sidebar', now()->addMinutes(5), function () {
            return Banner::with('items')->inPosition('panel-sidebar')->first();
        });
        $view->with('panelSidebar', $panelSidebar);
    }
}
