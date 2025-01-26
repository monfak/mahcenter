<?php

namespace App\Http\Controllers\Auth;

use App\Rules\Mobile;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\NationalCode;
use Illuminate\Foundation\Auth\RegistersUsers;
use Modules\Address\Entities\Province;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = '/panel';
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'    => ['required', 'string', 'max:191'],
            'last_name'     => ['required', 'string', 'max:191'],
            'email'         => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'string', 'min:6', 'confirmed'],
            'mobile'        => ['required', 'numeric', 'unique:users', new Mobile, ],
            //'city'          => 'required|exists:cities,id',
  
            //'national_code' => 'required|size:10','numeric', 'unique:users',
            //'phone'         => 'required|size:11',
            //'post_code'     => 'required|size:10',
            //'address'       => 'required',
            //'province'   => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'         => $data['email'],
            'mobile'        => $data['mobile'],
            'password'      => Hash::make($data['password']),
            //'national_code' => $data['national_code'],
        ]);

        /*$user->addresses()->create([
            'user_id'       => $user->id,
            'name'          => 'خانه',
            'phone'         => $data['phone'],
            'city_id'       => $data['city'],
            'address'       => $data['address'],
            'post_code'     => $data['post_code'],
            'is_default'    => true,
        ]);*/

        return $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return redirect('login');
        return view('auth.register');
    }
}
