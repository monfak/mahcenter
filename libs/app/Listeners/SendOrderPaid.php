<?php
namespace App\Listeners;

use App\Events\OrderPaid;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Order\Entities\Order;
use Sms;

class SendOrderPaid
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
     * @param  App\Events\OrderPaid  $event
     * @return void
     */
    public function handle($event)
    {
      
        $user =$event->order->user;
     
        $message = 'سفارش شما موفق بوده و آماده ارسال است.';
  
       if($user->mobile){
           //Sms::send($message, $user->mobile); 
       }
    }
}
