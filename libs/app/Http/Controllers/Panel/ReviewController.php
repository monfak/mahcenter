<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $boughtProductIds = Order::where('user_id', $user->id)
                         ->with('products')
                         ->get()
                         ->pluck('products.*.id')
                         ->flatten()
                         ->unique();
        $reviewedProductIds = $user->reviews()->pluck('product_id');
        $productsWithoutReview = Product::with('manufacturer')->whereIn('id', $boughtProductIds)
                                ->whereNotIn('id', $reviewedProductIds)
                                ->paginate(10);

        $chunkedProducts = $productsWithoutReview->getCollection()->chunk(2);
        $productsWithoutReview->setCollection($chunkedProducts);
        return view('frontend.reviews.index', compact('productsWithoutReview'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = auth()->user();
        $provinces = Province::with('cities')->get();
        return view('frontend.addresses.create', compact('user', 'provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddressRequest $request
     * @return Response
     */
    public function store(AddressRequest $request)
    {
        $user = auth()->user();
        $addressData = $request->only(['name', 'phone', 'city_id', 'address', 'post_code']);
        $addressData['is_default'] = $request->input('is_default', false);
        $addressData['user_id'] = $user->id;
        $address = Address::create($addressData);
        if($address->is_default) {
            Address::where('user_id', $user->id)->where('id', '<>', $address->id)->update(['is_default' => false]);
        }
        success('آدرس جدید ایجاد گردید.');
        return redirect()->route('panel.addresses.index');
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
        abort_if($address->user_id !== auth()->id(), 404, 'صفحه مورد نظر وجود ندارد!');
        abort_if($address->deleted_at, 404);
        $address->load('user', 'users');
        $provinces      = Province::with('cities')->get();
        return view('frontend.addresses.edit', compact('address', 'provinces'));
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
        abort_if($address->user_id !== auth()->id(), 404, 'آدرس مورد نظر وجود ندارد!');
        abort_if($address->deleted_at, 404);
        $addressData = $request->only(['name', 'phone', 'city_id', 'address', 'post_code']);
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
        success('آدرس کاربر با موفقیت آپدیت شد.');
        return redirect()->route('panel.addresses.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param  Request  $request
     * @param  Address  $address
     * @return Response
     */
    public function destroy(Request $request, Address $address)
    {
        abort_if($address->user_id !== auth()->id(), 404, 'آدرس مورد نظر وجود ندارد!');
        abort_if($address->deleted_at, 404);
        if($address->orders()->exists()) {
            $address->update(['deleted_at' => now()]);
        } else {
            $address->delete();
        }
        success();
        return redirect()->route('panel.addresses.index');
    }
}
