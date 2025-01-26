<?php

namespace App\Http\Views\Composers;

use App\Models\Order;
use Illuminate\Contracts\View\View;

class UncheckedOrdersComposer
{
    public function compose(View $view)
    {
        $uncheckedOrdersCount = Order::unchecked()->count();
        $view->with('uncheckedOrdersCount', $uncheckedOrdersCount);
    }
}
