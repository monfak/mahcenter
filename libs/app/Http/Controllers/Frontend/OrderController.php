<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected $cartService;

    /**
     * OrderController constructor.
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function store(Request $request)
    {
        $cart = $this->cartService->getCart();
        if (!$cart)
        {
            doneMessage('سبد خرید شما خالی است!');

            return redirect()->route('cart');
        }
        $address = $this->cartService->getAddress($cart);
        if (!$address)
        {
            doneMessage('باید حداقل یک آدرس داشته باشید!');

            return redirect()->route('frontend.details.index');
        }

        // Check if any product in the cart requires a national ID
        $requiresNationalId = false;
        $user = auth()->user();
        $userHasNationalId = $user && !empty($user->national_code);

        foreach ($cart->items as $cartItem)
        {
            if ($cartItem->product->required_national_id)
            {
                $requiresNationalId = true;
                break;
            }
        }
        if ($requiresNationalId && !$userHasNationalId && empty($request->input('national_code'))) {
            error('فیلد کد ملی اجباری است!');

            return redirect()->route('checkout');
        }
        // Apply discount code logic (consider extracting this into a separate service if reusable)
        if ($request->input('discount') == 'discount' && $request->input('discountCode')) {
          $code = Code::where('code', $request->input('discountCode'))
          ->where('used', false)
          ->with('discount')
          ->first();

          if ($code && $code->discount->end_date > now() && now() >= $code->discount->start_date) {
              session(['discountId' => $code->discount->id, 'codeId' => $code->id]);
              success('کد تخفیف اعمال شد.');
              return back()->withInput();
          }

          doneMessage('کد تخفیف معتبر نیست.', 'error');
          return back()->withInput();
        }
        if (auth()->check())
        {
            $user = auth()->user();
            $userUpdates = array_filter([
                'first_name'    => $request->input('first_name', auth()->user()->first_name),
                'last_name'     => $request->input('last_name', auth()->user()->last_name),
                'name'          => trim($request->input('first_name', auth()->user()->first_name) . ' ' . $request->input('last_name', auth()->user()->last_name)),
                'national_code' => $request->input('national_code', auth()->user()->national_code),
            ]);

            if (!empty($userUpdates))
            {
                $user->update($userUpdates);
            }
        }
        //Order::whereUserId($user->id)->pending()->update(['status' => Order::STATUS_EXPIRED]);

        $orderData = [
            'address_id'       => $cart->address_id,
            'description'      => $request->input('description'),
            'user_ip'          => $request->getClientIp(),
            'user_agent'       => $request->header('User-Agent'),
            'status'           => Order::STATUS_PENDING,
            'cash_on_delivery' => $request->input('paymethod') == 'delivery' ? Order::CASH_ON_DELIVARY : Order::PAY_ONLINE,
        ];
        if (auth()->check())
        {
            $user = auth()->user();
            $orderData['mobile'] = $user->mobile;
            $orderData['user_id'] = $user->id;
            $orderData['tracking_code'] = uniqid($user->id);
        } else
        {
            $orderData['mobile'] = $cart->mobile;
            $orderData['first_name'] = $cart->first_name;
            $orderData['last_name'] = $cart->last_name;
            $orderData['name'] = $cart->name;
            $orderData['tracking_code'] = uniqid(rand(100000, 999999));
        }

        // Create the order
        $order = Order::query()->create($orderData);
        Log::info('Order created with ID: ' . $order->id);

        $totalSum = 0;
        $orderProducts = [];
        foreach ($cart->items as $cartItem)
        {
            $product = $cartItem->product;
            $price = (int)($product->special ?? $product->price);
            if ($cartItem->warranty_id)
            {
                $price += $cartItem->warranty->price;
            }
            $totalPrice = $price * $cartItem->quantity;

            $orderProducts[] = [
                'order_id'         => $order->id,
                'product_id'       => $product->id,
                'quantity'         => $cartItem->quantity,
                'price'            => $price,
                'warranty_id'      => $cartItem->warranty_id,
                'warranty_price'   => $cartItem->warranty?->price ?? null,
                'discount'         => 0,
                'discount_details' => null,
                'total_price'      => $totalPrice,
            ];

            $totalSum += $totalPrice;
        }
        OrderProducts::insert($orderProducts);
        Log::info('Order products inserted for Order ID: ' . $order->id);

        // Handle discount information
        /**$totalDiscount = 0;
         * $discountId = session('discountId');
         * if ($discountId) {
         * $discount = Discount::find($discountId);
         * $code = Code::find(session('codeId'));
         * }**/

        // Update order totals
        $order->update([
            'products_total_price' => $totalSum,
            'total_price'          => $totalSum,// - $totalDiscount,
            'discount'             => 0,//$totalDiscount,
        ]);

        // Clear the cart
        $this->cartService->delete($cart);
        Log::info('Cart deleted for user ID: ' . $cart->user_id);
        if ($order->cash_on_delivery)
        {
            success('سفارش شما با موفقیت ثبت شد. منتظر تماس کارشناسان ما باشید.');

            foreach ($order->products as $product)
            {
                $product->stock = max(0, $product->stock - $product->pivot->quantity);
                $product->save();
            }
            Log::info('Cash on delivery order created successfully for Order ID: ' . $order->id);

            /**if($discountId){
             * $code->update([
             * 'used' => true,
             * 'consumer_id' => auth()->user()->id,
             * ]);
             * session()->forget('discountId');
             * session()->forget('codeId');
             * }**/

            if ($order->mobile)
            {
                try
                {
                    send_sms($order->mobile, ['user' => $user->name ?? 'بدون نام', 'ordercode' => $order->id], 636222);
                } catch (\Exception $exception)
                {
                    Log::info('Error sending otp: ' . $exception);
                }
            }

            return redirect()->route('thankyou', $order->id);
        }
        if ($order->mobile)
        {
            try
            {
                send_sms($order->mobile, ['user' => $user->name ?? 'بدون نام', 'ordercode' => $order->id], 636222);
            } catch (\Exception $exception)
            {
                Log::info('Error sending otp: ' . $exception);
            }
        }
        Log::info('Redirecting to payment request for Order ID: ' . $order->id);

        /**if(auth()->user()->id == 2 && $request->input('paymethod') == "sadad")
         * {
         * return redirect()->route('payments.request.sadad', ['order' => $order->id]);
         * }**/

        return redirect()->route('payments.request', ['order' => $order->id]);
    }

    public function index()
    {
        $orders = Order::whereUserId(auth()->id())->latest()->paginate();

        return view('frontend.accounts.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_unless($order->user_id == auth()->id(), 403);
        $order->load('products', 'payments', 'user', 'address.city.province');
        $address = $order->address;

        return view('frontend.accounts.order', compact('order', 'address'));
    }
}
