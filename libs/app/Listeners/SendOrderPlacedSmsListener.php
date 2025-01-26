<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Jobs\SendOrderPlacedSms;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderPlacedSmsListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPlaced $event): void
    {
        SendOrderPlacedSms::dispatch($event->order);
    }
}
