<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use App\Models\Verification;
use App\Events\OtpRequested;
use App\Services\CartService;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;
    protected $cartService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CartService $cartService)
    {
        //$this->middleware('guest');
        $this->cartService = $cartService;
    }

    public function showLoginForm()
    {
        return view('auth.auth');
    }

    public function auth(Request $request)
    {
        $username = to_latin_numbers($request->input('username'));
        if(empty($username)) {
            $message = [
                'status' => 'danger',
                'toast' => 'فیلد شماره موبایل یا ایمیل نمی‌تواند خالی باشد!',
            ];
            return response()->json($message);
        }
        if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $username)->first();
            if(!$user) {
                $message = [
                    'status' => 'danger',
                    'toast' => 'حساب کاربری با مشخصات وارد شده وجود ندارد. لطفا از شماره تلفن همراه برای ساخت حساب کاربری استفاده نمایید.',
                ];
                return response()->json($message);
            }
            $message = [
                'status' => 'success',
                'usernameType' => 'email',
                'passwordType' => 'password',
                'heading' => 'رمز عبور را وارد کنید',
                'description' => '',
                'link' => '<a href="#">فراموشی رمز عبور</a>',
                'button' => 'تایید',
                'formAction' => route('auth.login'),
            ];
            return response()->json($message);
        }
        if(preg_match("/^09(0[1-5]|1[0-9]|3[0-9]|2[0-2]|9[0-2])-?[0-9]{3}-?[0-9]{4}$/", $username)) {
            $user = User::where('mobile', $username)->first();
            if(!$user) {
                $verification = Verification::create(['mobile' => $username]);
                
                event(new OtpRequested($verification));
                
                $message = [
                    'status' => 'success',
                    'usernameType' => 'mobile',
                    'passwordType' => 'otp',
                    'heading' => 'کد تایید را وارد کنید',
                    'description' => "حساب کاربری با شماره موبایل {$username} وجود ندارد. برای ساخت حساب جدید، کد تایید برای این شماره ارسال گردید.",
                    'button' => 'تایید',
                    'formAction' => route('auth.verify'),
                ];
                return response()->json($message);
            }
            if($user->password == null OR $request->input('send-otp', false) === 'true') {
                $verification = Verification::create(['mobile' => $username]);
                event(new OtpRequested($verification));
                $message = [
                    'status' => 'success',
                    'usernameType' => 'mobile',
                    'passwordType' => 'otp',
                    'heading' => 'کد تایید را وارد کنید',
                    'description' => "کد تایید برای شماره {$username} پیامک شد.",
                    'button' => 'تایید',
                    'formAction' => route('auth.verify'),
                ];
                return response()->json($message);
            }
            $message = [
                'status' => 'success',
                'usernameType' => 'mobile',
                'passwordType' => 'password',
                'heading' => 'رمز عبور را وارد کنید',
                'description' => '',
                'link' => '<a href="#">فراموشی رمز عبور</a>',
                'button' => 'تایید',
                'formAction' => route('auth.login'),
            ];
            return response()->json($message);
        }
        $message = [
            'status' => 'danger',
            'toast' => 'فرمت شماره موبایل یا ایمیل وارد شده اشتباه است!',
        ];
        return response()->json($message);
    }

    public function login(Request $request)
    {
        $username = to_latin_numbers($request->input('username'));
        $type = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        $password = $request->input('password');
        
        $guestSessionId = $request->session()->getId();
        
        if(Auth::attempt([$type => $username, 'password' => $password])) {
            $request->session()->regenerate();
            
            $this->mergeGuestCartToUserCart($guestSessionId, auth()->user()->id);
            
            success('شما با موفقیت وارد شدید.');
            return auth()->user()->can('manage-store') ? redirect()->to('/admin') : redirect()->to('/panel/edit');
        }
        doneMessage('نام کاربری یا پسورد اشتباه است.');
        return redirect()->back()->withErrors(['wrong' => 'نام کاربری یا پسورد اشتباه است.']);
    }

    public function verify(Request $request)
    {
        // type must be mobile, add rule in request file
        /*
        * "_token" => "MGWMWBgymcSX2c8U6tVaB5vUb8pN6XqjFAKQNabM"
        * "type" => "mobile"
        * "username" => "09333189053"
        * "password" => null
        * "otp" => "27414"
        */
        $mobile = to_latin_numbers($request->input('username'));
        $otp = to_latin_numbers($request->input('otp'));
        $verification = Verification::where('mobile', $mobile)->where('otp', $otp)->valid()->first();
        if(!$verification) {
            return redirect()->back()->withErrors(['wrong' => 'کد وارد شده اشتباه است.']);
        }
        $user = User::query()->firstOrCreate(
            ['mobile' =>  $mobile],
            []
        );
        
        $guestSessionId = $request->session()->getId();
    
        Auth::loginUsingId($user->id);
        
        $this->mergeGuestCartToUserCart($guestSessionId, $user->id);
        
        $request->session()->regenerate();
        
        $verification->update(['is_used' => true]);
        success('شما با موفقیت وارد شدید.');
        if(auth()->user()->can('manage-store')) {
            return redirect()->to('/admin');
        }
        return redirect()->to('/panel/edit');
    }

    public function logout(Request $request)
    {
        \Log::info('Logout method called');
    
        Auth::guard()->logout();
    
        \Log::info('User logged out');
    
        $request->session()->invalidate();
    
        \Log::info('Session invalidated');
    
        $request->session()->regenerateToken();
    
        \Log::info('Token regenerated');
    
        return redirect('/');
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);

        return $this->authenticated($request, Auth::user())
            ?: redirect()->intended($this->redirectPath());
    }
    
    protected function mergeGuestCartToUserCart($sessionId, $userId)
    {
        $guestCart = Cart::where('session_id', $sessionId)->first();
        $userCart = Cart::where('user_id', $userId)->first();
    
        if ($guestCart && $userCart) {
            foreach ($guestCart->items as $item) {
                $userCartItem = $userCart->items()->where('product_id', $item->product_id)->first();
                if ($userCartItem) {
                    $userCartItem->quantity += $item->quantity;
                    $userCartItem->save();
                } else {
                    $userCart->items()->create([
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                    ]);
                }
            }
            $guestCart->delete();
            
            $this->cartService->updateCartTotal($userCart);
        } elseif ($guestCart && !$userCart) {
            $guestCart->update(['user_id' => $userId, 'session_id' => null]);
        }
    }
}
