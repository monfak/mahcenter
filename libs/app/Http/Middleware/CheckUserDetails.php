<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserDetails
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->first_name === null || $user->last_name === null || $user->national_code === null) {
            $message = 'برای خرید باید نام، نام خانوادگی و کدملی خود را ثبت کنید.';
            session()->flash('msg', [
                'status' => 'danger',
                'title' => 'خطا',
                'message' => $message,
            ]);
            return redirect()->route('accounts.edit')->with('errors', $message);
        }

        return $next($request);
    }
}