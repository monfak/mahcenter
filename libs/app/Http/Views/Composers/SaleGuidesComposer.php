<?php

namespace App\Http\Views\Composers;

use App\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class SaleGuidesComposer
{
    public function compose(View $view)
    {
        $saleGuides = Cache::remember('sale-guides', now()->addMinutes(5), function() {
            return Menu::with(['items' => function($query){
                $query->active();
            }])->inPosition('sale-guides')->first();
        });
        $view->with('saleGuides', $saleGuides);
    }
}
