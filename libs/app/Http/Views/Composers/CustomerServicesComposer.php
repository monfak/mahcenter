<?php

namespace App\Http\Views\Composers;

use App\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class CustomerServicesComposer
{
    public function compose(View $view)
    {
        $customerServices = Cache::remember('customer_services', now()->addMinutes(5), function() {
            return Menu::with(['items' => function($query){
                $query->active();
            }])->inPosition('customer-services')->first();
        });
        $view->with('customerServices', $customerServices);
    }
}
