<?php

namespace App\Http\Views\Composers;

use App\Models\Banner;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class NotificationComposer
{
    public function compose(View $view)
    {
        $notification = Cache::remember('notification', now()->addMinutes(5), function () {
            return Banner::with('items')->inPosition('notification')->first();
        });
        $view->with('notification', $notification);
    }
}
