<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Support\Facades\Cache;

class CheckoutController extends Controller
{
    protected $cartService;

    /**
     * CheckoutController constructor.
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Show the specified resource.
     */
    public function show()
    {
        $cart = $this->cartService->getCart();
        if (!$cart) {
            doneMessage('سبد خرید شما خالی است!');
            return redirect()->route('cart');
        }
        $address = $this->cartService->getAddress($cart);
        if (!$address) {
            doneMessage('باید حداقل یک آدرس داشته باشید!');
            return redirect()->route('frontend.details.index');
        }
        $shippingPrice = 0;
        $products = null;
        $totalSum = 0;
        $totalSumCart = 0;
        $totalWeight = 0;
        $shipping_price = 0;
        $totalPrice = 0;
        $totalDiscount = 0;

        $cartItems = $cart->items()->with('product')->get();
        $requiresNationalId = false;
        $requiresNationalIdProducts = [];
        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
            if ($product->stock - $cartItem->quantity < 0) {
                session()->flash('msg', ['status' => 'error', 'message' => 'موجودی محصول ' . $product->name . 'کافی نیست لطفا از سبد خرید حذف کنید ', 'title' => '']);
                return redirect(route('cart'));
            }
            if ($cartItem->product->required_national_id) {
                $requiresNationalId = true;
                $requiresNationalIdProducts[] = $product->name;
            }
            $price = (int)($product->special ?? $product->price);
            if ($cartItem->warranty_id) {
                $price += $cartItem->warranty->price;
            }
            $totalPrice = $price * $cartItem->quantity;

            $products[] = [
                'id' => $product->id,
                'slug' => $product->slug,
                'image' => $product->image,
                'name' => $product->name,
                'model' => $product->model,
                'variety_label' => $product->variety_label,
                'variety_value' => $product->variety_value,
                'quantity' => $cartItem->quantity,
                'warranty' => $cartItem->warranty?->name ?? null,
                'price' => $price,
                'totalPrice' => $totalPrice,
            ];
            if ($product->special) {
                $totalDiscount += (($product->price - $product->special) * $cartItem->quantity);
            }
            $totalSum += $totalPrice;
        }
        $requiresNationalIdProducts = implode(' و ', $requiresNationalIdProducts);

        $totalPriceProduct = $totalSum + $totalDiscount;
        $shippingPricePage = Cache::remember('shipping-price-page', now()->addMinutes(5), function () {
            return Page::query()
                ->where('slug', 'هزینه-ارسال')
                ->first();
        });
        return view('frontend.checkout.show',
            compact(
                'totalSum',
                'cart',
                'products',
                'totalSum',
                'address',
                'shippingPrice',
                'totalPriceProduct',
                'totalSumCart',
                'totalDiscount',
                'shippingPricePage',
                'requiresNationalId',
                'requiresNationalIdProducts'
            ));
    }

    public function thankyou(Order $order)
    {
        $order->load('products', 'address');
        if (auth()->check()) {
            if ($order->user_id != auth()->id()) {
                abort(403, 'شما مجاز به مشاهده این سفارش نیستید.');
            }
        } else {
            $sessionOrderId = session('order_id');
            if ($sessionOrderId != $order->id) {
                abort(403, 'شما مجاز به مشاهده این سفارش نیستید.');
            }
        }
        $purchasedProductIds = $order->products->pluck('id')->toArray();
        $categories = $order->products->pluck('category_id')->unique()->toArray();

        $recommendedProducts = Product::whereIn('category_id', $categories)
            ->whereNotIn('id', $purchasedProductIds)
            ->inRandomOrder()
            ->distinct()
            ->take(2)
            ->get();
        return view('frontend.checkout.thankyou', compact('order', 'recommendedProducts'));
    }
}
