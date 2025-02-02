<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartGuestRequest;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    
    public function index()
    {
        $cart = $this->cartService->getCart();

        $products = null;
        $totalSum = 0;
        $cartItems = [];
        $crossProducts = collect();
    
        if ($cart) {
            $cartItems = $cart->items()->with(['product' => function($query) {
                $query->with('crossProducts')->where('stock', '>', 0)->where('price', '>', 0);
            }, 'warranty'])->get();
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
                    'price'         => $price,
                    'warranty'      => $cartItem->warranty?->name ?? null,
                    'totalPrice'    => $totalPrice,
                ];
                
                $crossProducts = $crossProducts->merge($product->crossProducts);
    
                $totalSum += $totalPrice;
            }
            $crossProducts = $crossProducts->unique('id')->take(10)->values();
        }
        return view('frontend.cart.index', compact('products', 'totalSum', 'cart', 'crossProducts'));
    }
    
    public function addNormal(Request $request, $id)
    {
        $id = (int) $id;

        if (!$product = Product::whereId($id)->whereStatus(true)->first()) {
            error("محصول انتخاب شده وجود ندارد.");
            return back();
        }

        $quantity = (int) $request->quantity;
        $warrantyId = (int) $request->input('warranty_id', null);
        if($warrantyId == 0) {
            $warrantyId = null;
        }

        if ($quantity < 1) {
            error("حداقل تعداد انتخاب شده باید یک عدد باشد.");

            return back();
        }

        if ($product->stock == 0) {
            error("موجودی این محصول در انبار به اتمام رسیده و امکان سفارش آن وجود ندارد.");

            return back();
        }
        if ($product->stock && $product->stock - $quantity >= 0) {
            $this->cartService->addToCart($product->id, $quantity, $warrantyId);
        } else {
            error("موجودی محصول کافی نیست.");
            return back();
        }

        $itemsInBasket = $this->cartService->getCartDetails();

        success("محصول با موفقیت به سبد خرید شما اضافه گردید.");
        
        return back();
    }

    public function add(Request $request, $id)
    {
        abort_unless($request->ajax(), 404);

        $id = (int) $id;

        if (!$product = Product::whereId($id)->whereStatus(true)->first()) {
            $message = [
                'status' => 'danger',
                'body' => "محصول انتخاب شده وجود ندارد.",
            ];
            return response()->json($message);
        }

        $quantity = (int) $request->quantity;
        $warrantyId = (int) $request->input('warranty_id', null);
        if($warrantyId == 0) {
            $warrantyId = null;
        }

        if ($quantity < 1) {
            $message = [
                'status' => 'danger',
                'body' => "حداقل تعداد انتخاب شده باید یک عدد باشد.",
            ];

            return response()->json($message);
        }

        if ($product->stock == 0) {
            $message = [
                'status' => 'danger',
                'body' => "موجودی این محصول در انبار به اتمام رسیده و امکان سفارش آن وجود ندارد.",
            ];

            return response()->json($message);
        }
        if ($product->stock && $product->stock - $quantity >= 0) {
            $this->cartService->addToCart($product->id, $quantity, $warrantyId);
        } else {
            $message = [
                'status'        => 'danger',
                'body'          => "موجودی محصول کافی نیست.",
            ];
            return response()->json([$message]);
        }

        $itemsInBasket = $this->cartService->getCartDetails();

        $response = [
            'status' => 'success',
            'body' => "محصول با موفقیت به سبد خرید شما اضافه گردید.",
            'itemsInBasket' => $itemsInBasket,
        ];
        
        return response()->json($response);
    }

    public function update(Request $request, $id)
    {
        $productId = (int) $id;
        $quantity = $request->input('quantity', 0);
    
        // Find the product, ensure it exists
        $product = Product::findOrFail($productId);
    
        if ($quantity < 1) {
            session()->flash('msg', [
                'status' => 'success',
                'title' => '',
                'message' => 'حداقل تعداد محصول باید ۱ عدد باشد.',
            ]);
            return redirect()->route('cart');
        }
    
        // Ensure the cart exists or create one if necessary
        $cart = $this->cartService->getOrCreateCart();
    
        // Find the cart item or fail if it doesn't exist
        $cartItem = $cart->items()->where('product_id', $productId)->first();
    
        if (!$cartItem) {
            session()->flash('msg', [
                'status' => 'success',
                'title' => '',
                'message' => 'محصول مورد نظر شما در سبد خرید وجود ندارد.',
            ]);
            return redirect()->route('cart');
        }
    
        $cartItem->update(['quantity' => $quantity]);
        
        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => 'سبد خرید بروزرسانی گردید.',
        ]);
    
        return redirect()->route('cart');
    }

    public function destroy(Request $request, $id)
    {
        $productId = (int) $id;
    
        // Ensure the cart exists
        $cart = $this->cartService->getCart();
    
        if (!$cart) {
            session()->flash('msg', [
                'status' => 'success',
                'title' => '',
                'message' => 'سبد خرید شما خالی است.',
            ]);
            return redirect()->route('cart');
        }
    
        // Find the cart item and remove it
        $cartItem = $cart->items()->where('product_id', $productId)->first();
    
        if ($cartItem) {
            $cartItem->delete();
    
            // If the cart is now empty, consider deleting the cart (optional)
            if ($cart->items()->count() === 0) {
                $cart->delete();
            }
        } else {
            return redirect()->route('cart')->withErrors('Product not found in cart.');
        }
    
        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "سبد خرید با موفقیت آپدیت شد.",
        ]);
    
        return redirect()->route('cart');
    }

    public function display(Request $request)
    {
        $lastPrice = $request->lastPrice;
        $product = Product::findOrFail($request->productid);
        $price = $product->price;
        $productPriceDefault=$product->price;
        $productSpecialPrice = $product->special ?: $product->price;
        $newOptions = $request->options;
        $option = json_decode($newOptions, true) ?? [];

        if (isset($option['values'])) {
            foreach ($option['values'] as $index => $otp) {
                if ($otp != 0) {
                   $price = $this->processOption($otp, $product);
                }
            }
        } else {
           $otp = head($option);
           $price= $this->processOption($otp, $product);
        }

        $message = [
            'productPriceDefault' => number_format($productPriceDefault) . 'تومان',
            'price' => number_format(abs($price)),
        ];

        return response()->json($message);
    }

    private function processOption($otp, $product)
    {
        $value = \DB::table('product_option_values')
            ->where('option_value_id', $otp)
            ->whereIn('product_option_id', $product->options->pluck('id'))
            ->get();

        //   $value = DB::table('product_option_values')
        //             ->where('option_value_id', $otp)
        //             ->whereIn('product_option_id', $product->options->pluck('id'))->get();

        if ($value->isEmpty()) {
            return redirect(route('home'));
        }

        $productPrice = $product->price;

        if (!is_null($product->special)) {
            $price = (int) $product->special;
        } else{
            $price = (int) $product->price;
        }

        if ($value[0]->surplus_price) {


        $price = $price - $value[0]->price;
        $delPrice = $productPrice - $value[0]->price;

        // $t = DB::table('option_values')
        //     ->where('id', $otp)->first();
        // $name .= '(' . $t->name . ')';
        //     dd($t);

        } else {
            $price = $price + $value[0]->price;
            $delPrice = $productPrice + $value[0]->price;
        }
        return $price;
    }
    
    public function getCart()
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        }
        $sessionId = session()->getId();
        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }
    
    public function guest(CartGuestRequest $request)
    {
        $cart = $this->cartService->getOrCreateCart();
        
        $cart->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'name' => trim($request->input('first_name') . ' ' . $request->input('last_name')),
            'mobile' => to_latin_numbers($request->input('mobile')),
        ]);
        return redirect()->route('frontend.details.index');
    }
}
