<?php

namespace App\Http\Views\Composers;

use App\Models\Ticket;
use Illuminate\Contracts\View\View;

class OpenTicketsComposer
{
    public function compose(View $view)
    {
        $openTicketsCount = Ticket::whereStatus(true)->count();
        $view->with('openTicketsCount', $openTicketsCount);
    }
}
