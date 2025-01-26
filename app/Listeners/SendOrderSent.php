<?php

namespace App\Listeners;

use App\Events\OrderSent;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Order\Entities\Order;
use Sms;

class SendOrderSent
{
    /**
     * Create the event listener.
     *
     * @param  Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  App\Events\OrderSent  $event
     * @return void
     */
    public function handle(OrderSent $event)
    {
        $order = Order::with('user')->where('id', $event->id)->first();
        $user = $order->user;
        $message = 'سفارش شما در وضعیت ارسال شده قرار گرفت.';
        if($user->mobile) {
            Sms::send($message, $user->mobile);
        }
    }
}
