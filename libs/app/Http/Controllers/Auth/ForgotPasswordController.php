<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\Mobile;
use App\User;
use App\Traits\ResetPassword;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    use SendsPasswordResetEmails;
    use ResetPassword;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkSms(Request $request)
    {
        $request->validate([
            'mobile' => ['required', new Mobile, 'exists:users,mobile']
        ]);

        $passwordReset = $this->createToken($request->mobile);
 
        if($passwordReset == null) {
            return back();
        }
        $user=User::where('mobile',$passwordReset->mobile)->first();
        
     
        $this->sendResetLink($passwordReset->mobile, $passwordReset->token);
        
        return redirect()->route('password.reset', ['mobile' => $passwordReset->token]);
    }
}
