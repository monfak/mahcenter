<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Province;
use App\Models\Order;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $activeOrdersCount = Order::where('user_id', auth()->id())->whereIn('status', [1, 2, 3])->count();
        $deliveredOrdersCount = Order::where('user_id', auth()->id())->where('status', 5)->count();
        $failedOrdersCount = Order::where('user_id', auth()->id())->whereIn('status', [0, 4])->count();
        $products = auth()->user()->wishlist()->published()->take(10)->get();
        return view('frontend.accounts.index', compact('activeOrdersCount', 'deliveredOrdersCount', 'failedOrdersCount', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('frontend.accounts.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateAccountRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAccountRequest $request)
    {
        $user = auth()->user();
        $userData = $request->only(['first_name', 'last_name', 'email']);
        $userData['name'] = $userData['first_name'] . ' ' . $userData['last_name'];
        $userData['national_code'] = to_latin_numbers($request->input('national_code'));
        dd($userData);
        $user->update($userData);
        $this->doneMessage('اطلاعات حساب کاربری شما با موفقیت آپدیت شد.');
        return redirect()->route('accounts.edit');
    }

    /**
     * Show the form for editing the password.
     * @return Response
     */
    public function password()
    {
        return view()->first(['frontend.accounts.password', 'Account::password']);
    }

    /**
     * Update the password in storage.
     * @param UpdatePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        $user->password = Hash::make($request->password);

        $user->save();

        $this->doneMessage('پسورد حساب کاربری شما با موفقیت آپدیت شد.');

        return redirect()->route('accounts.index');
    }

    /**
     * Show the form for a specific address in storage.
     * @return Response
     */
    public function address()
    {
        $provinces      = Province::with('cities')->get();
        $userAddress    = auth()->user()->latestAddress();
        return view()->first(['frontend.accounts.address', 'Account::address'], compact('provinces', 'userAddress'));
    }

    /**
     * Update the address in storage.
     * @param UpdateAddressRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAddress(UpdateAddressRequest $request)
    {
        $user           = auth()->user();
        $userAddress    = $user->latestAddress();

        // Creates new address if any of the following fields has been changed.

        if(
            ($userAddress->phone        != $request->input('phone')) OR
            ($userAddress->city_id      != $request->input('city')) OR
            ($userAddress->address       != $request->input('address')) OR
            ($userAddress->post_code    != $request->input('post_code'))
        )
        {

            $user->addresses()->create([
                'user_id'       => $user->id,
                'name'          => $user->name,
                'phone'         => to_latin_numbers($request->input('phone')),
                'city_id'       => $request->input('city'),
                'address'       => $request->input('address'),
                'post_code'     => to_latin_numbers($request->input('post_code')),
            ]);
        }

        $this->doneMessage('آدرس شما با موفقیت آپدیت شد.');

        return redirect()->route('accounts.index');
    }

    public function order(Request $request)
    {
        $orders = Order::where('user_id', auth()->id())->latest()->paginate();
        return view('frontend.accounts.orders', compact('orders'));
    }
}
