<?php

namespace App\Listeners;

use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Sms;

class SendRegistrationSms
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $verification = $event->verification;
        try {
            send_sms($verification->mobile, ['otp' => $verification->otp], 124223);
        } catch(\Exception $exception){
            Log::info('Error sending otp: ' . $exception);
        }
    }
}
