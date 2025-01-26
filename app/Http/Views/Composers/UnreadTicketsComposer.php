<?php

namespace App\Http\Views\Composers;

use App\Models\Ticket;
use Illuminate\Contracts\View\View;

class UnreadTicketsComposer
{
    public function compose(View $view)
    {
        $unreadTickets = Ticket::where('user_id', auth()->user()->id)->count();
        $view->with('unreadTickets', $unreadTickets);
    }
}
