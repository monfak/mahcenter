<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\DetailsGuestRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\Page;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

class DetailController extends Controller
{
    protected $cartService;
    
    /**
     * DetailController constructor.
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function index()
    {
        $cart = $this->cartService->getCart();
        if(!$cart) {
            doneMessage('سبد خرید شما خالی است!');
            return redirect()->route('cart');
        }
        
        $shippingPrice = 0;
        $products = null;
        $totalSum = 0;
        $totalDiscount = 0;
        $cartItems = [];
        $cartAddress= null;
        $addresses = [];
        $user = null;
    
        if(auth()->check()) {
            $user = auth()->user();
            
            $addresses = $user->addresses()->with('city.province')->active()->get();
            
            foreach($addresses as $address) {
                if($address->is_default) {
                    $cartAddress = $address->id;
                }
            }
            
            if ($cartAddress === null && count($addresses)) {
                $cartAddress = $addresses->first()->id;
            }
            
            if ($cart->address_id === null && $cartAddress !== null) {
                $this->cartService->setAddress($cart, $cartAddress);
            }
        } else {
            if (!$cart->first_name || !$cart->last_name || !$cart->mobile) {
                doneMessage('لطفا اطلاعات شخصی خود را وارد کنید.');
                return redirect()->route('cart')->withErrors('لطفا اطلاعات شخصی خود را وارد کنید.');
            }
            if ($cart->address_id !== null) {
                $cartAddress = $cart->address_id;
                $cart->load('address.city');
            }
        }
        
        $cartItems = $cart->items()->with('product')->get();
        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
            $price = (int) ($product->special ?? $product->price);
            if($cartItem->warranty_id) {
                $price += $cartItem->warranty->price;
            }
            $totalPrice = $price * $cartItem->quantity;

            $products[] = [
                'id'            => $product->id,
                'slug'          => $product->slug,
                'image'         => $product->image,
                'name'          => $product->name,
                'model'         => $product->model,
                'variety_label' => $product->variety_label,
                'variety_value' => $product->variety_value,
                'quantity'      => $cartItem->quantity,
                'warranty'      => $cartItem->warranty?->name ?? null,
                'price'         => $price,
                'totalPrice'    => $totalPrice,
            ];
            if($product->special) {
                $totalDiscount += (($product->price - $product->special) * $cartItem->quantity);
            }
            $totalSum += $totalPrice;
        }
        $cities = Cache::remember('ordered-cities', now()->addMinutes(5), function () {
            return City::query()->oldest('name')->get();
        });
        $shippingPricePage = Cache::remember('shipping-price-page', now()->addMinutes(5), function() {
            return Page::query()
                ->where('slug', 'هزینه-ارسال')
                ->first();
        });
        return view('frontend.details.index', compact('products', 'totalSum', 'shippingPrice', 'user', 'addresses', 'totalDiscount', 'cart', 'cartAddress', 'cities', 'shippingPricePage'));
    }

    public function store(Request $request)
    {
        if (!auth()->check())
        {
            $message = [
                'status'    => 'danger',
                'body'      => "شما لاگین نیستید!",
            ];
            return response()->json($message);
        }
        if (!$request->input('address'))
        {
            $message = [
                'status'    => 'danger',
                'body'      => "باید آدرس انتخاب شده باشد.",
            ];
            return response()->json($message);
        }
        $user = auth()->user();
        $user->load('addresses');
        $addressId = $request->input('address');
        $addresses = $user->addresses;
        $addressNotSet = true;
        if(count($addresses)) {
            foreach($addresses as $address) {
                if($address->id == $addressId) {
                    $cart = $this->cartService->getCart();
                    $this->cartService->setAddress($cart, $addressId);
                    $message = [
                        'status'    => 'success',
                        'body'      => "آدرس با موفقیت برای سبد خرید فعلی ست شد.",
                    ];
                    return response()->json($message);
                }
            }
            if($addressNotSet) {
                $message = [
                    'status'    => 'danger',
                    'body'      => "آدرس باید متعلق به شما باشد.",
                ];
                return response()->json($message);
            }
        } else {
            $message = [
                'status'    => 'danger',
                'body'      => "باید حداقل یک آدرس داشته باشید تا بتوانید خرید را ادامه بدهید.",
            ];
            return response()->json($message);
        }

    }
    
    public function guest(DetailsGuestRequest $request)
    {
        $cart = $this->cartService->getCart();
        if(!$cart) {
            doneMessage('سبد خرید شما خالی است!');
            return redirect()->route('cart');
        }
        $addressData = $request->only(['city_id', 'address']);
        $addressData['phone'] = to_latin_numbers($request->input('phone'));
        $addressData['post_code'] = to_latin_numbers($request->input('post_code'));
        $addressData['name'] = 'خانه';
        if ($cart->address_id) {
            $address = Address::find($cart->address_id);
            if ($address) {
                $address->update($addressData);
            }
        } else {
            $address = Address::create($addressData);
            $cart->update(['address_id' => $address->id]);
        }
        success('آدرس شما با موفقیت ثبت شد.');
        return redirect()->route('checkout');
    }
}
