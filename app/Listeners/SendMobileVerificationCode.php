<?php

namespace App\Listeners;

use App\Events\VerificationCodeRequested;
use App\Models\TwoFactor;
use Illuminate\Http\Request;
use Ipecompany\Smsirlaravel\SmsirlaravelServiceProvider;

class SendMobileVerificationCode
{
    /**
     * Create the event listener.
     *
     * @param \Illuminate\Http\Request $request
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
    public function handle(VerificationCodeRequested $event)
    {
        $user = $event->user;

        $twoFactor = new TwoFactor([
            'code'      => TwoFactor::generateCode(),
            'user_id'   => $user->id,
        ]);
        $twoFactor->save();

        $user->two_factor_verified_at = null;
        $user->save();

        
        // Smsir::ultraFastSend(['VerificationCode'=>$twoFactor->code],14229,$user->mobile);
    }
}
