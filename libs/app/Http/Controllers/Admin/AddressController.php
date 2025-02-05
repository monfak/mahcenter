<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\City;
use App\Models\Province;
use App\Http\Requests\AddressRequest;
use App\Services\ActivityLogService;
use Illuminate\Support\Facades\Hash;

class AddressController extends Controller
{
    /**
     * AddressController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:users-manage');
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(User $user, Request $request)
    {
        if($request->ajax()) {
           $addresses = $user->addresses()->with('city.province')->get(); 
           return response()->json([
               'status' => 'success',
               'body' => 'آدرس را انتخاب کنید',
               'addresses' => $addresses,
           ]);
        }
        $addresses = $user->addresses()->with('city.province')->paginate();
        return view('admin.addresses.index', compact('addresses', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(User $user)
    {
        //$provinces = Province::with('cities')->get();
        $cities = City::query()->oldest('name')->get();
        return view('admin.addresses.create', compact('user', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddressRequest $request
     * @return Response
     */
    public function store(User $user, AddressRequest $request)
    {
        $addressData = $request->only(['name', 'city_id', 'address']);
        $addressData['phone'] = to_latin_numbers($request->input('phone'));
        $addressData['post_code'] = to_latin_numbers($request->input('post_code'));
        $addressData['is_default'] = $request->input('is_default', false);
        $addressData['user_id'] = $user->id;
        $address = Address::create($addressData);
        if($address->is_default) {
            Address::where('user_id', $user->id)->where('id', '<>', $address->id)->update(['is_default' => false]);
        }
        $log = $this->activityLogService->init('آدرس', 'created')->prepare($address)->finalize()->save();
        success('آدرس جدید ایجاد گردید.');
        return redirect()->route('admin.users.addresses.index', $user->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Address $address
     * @return Response
     */
    public function edit(Address $address)
    {
        abort_if($address->deleted_at, 404);
        $address->load('user', 'users');
        //$provinces      = Province::with('cities')->get();
        $cities = City::query()->oldest('name')->get();
        return view('admin.addresses.edit', compact('address', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUser $request
     * @param integer $id
     * @return Response
     */
    public function update(AddressRequest $request, Address $address)
    {
        abort_if($address->deleted_at, 404);
        $log = $this->activityLogService->init('آدرس', 'updated')->prepare($address, 'old');
        $addressData = $request->only(['name', 'city_id', 'address']);
        $addressData['phone'] = to_latin_numbers($request->input('phone'));
        $addressData['post_code'] = to_latin_numbers($request->input('post_code'));
        $changed = false;
        if(
            $addressData['name'] != $address->name OR
            $addressData['phone'] != $address->phone OR
            $addressData['city_id'] != $address->city_id OR
            $addressData['address'] != $address->address OR
            $addressData['post_code'] != $address->post_code
        ) {
            $changed = true;
        }
        $addressData['is_default'] = $request->input('is_default', false);
        if($address->orders()->exists() && $changed) {
            $addressData['user_id'] = $address->user_id;
            $address->update(['deleted_at' => now()]);
            Address::create($addressData);
        } else {
            $address->update($addressData);
        }
        if($address->is_default) {
            Address::where('user_id', $address->user_id)->where('id', '<>', $address->id)->update(['is_default' => false]);
        }
        $log->prepare($address)->finalize()->save();
        success('آدرس کاربر با موفقیت آپدیت شد.');
        return redirect()->route('admin.users.addresses.index', $address->user_id);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Request  $request
     * @param  Address  $address
     * @return Response
     */
    public function destroy(Request $request, Address $address)
    {
        abort_if($address->deleted_at, 404);
        $userId = $address->user_id;
        $log = $this->activityLogService->init('آدرس', 'deleted')->prepare($address, 'old')->finalize()->save();
        if($address->orders()->exists()) {
            $address->update(['deleted_at' => now()]);
        } else {
            $address->delete();
        }
        success();
        return redirect()->route('admin.users.addresses.index', $userId);
    }
}
