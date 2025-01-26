<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Cart\Entities\Cart;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (auth()->check() && !session()->get('cart.products'))
        {
            $cart = Cart::whereUserId(auth()->id())->first();
            session(['cart.products' => unserialize($cart->content)]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
