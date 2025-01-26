<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
 
class SendOrderPlacedSms implements ShouldQueue
{
    use Queueable;
    
    protected $order;

    /**
     * Create a new job instance.
     * 
     * @param  Order  $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mobile = $this->order->mobile ?? $this->order->user->mobile;
        $user = $this->order->name ?? $this->order->user->name;
        $orderId = $this->order->id;
        try {
            send_sms($mobile, ['user' => $user, 'OrderCode' => $orderId], 52897);
        } catch(\Exception $exception){
            Log::info('Error sending order placed sms: ' . $exception);
        }
    }
}
