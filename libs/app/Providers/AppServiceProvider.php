<?php

namespace App\Providers;

use App\Channels\SmsChannel;
use App\Models\Cart;
use Illuminate\Support\Facades\Notification;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') == 'production') {
            $this->app->bind('path.public', function() {
                return realpath(base_path().'/../public_html');
            });
            URL::forceScheme('https');
        }
        Notification::extend('sms', function ($app) {
            return new SmsChannel();
        });
        Paginator::useBootstrap();

        if (auth()->check() && is_null(session()->get('cart.products')))
        {
            $cart = $this->cart ?? Cart::whereUserId(auth()->id())->first();
            if ($cart)
            {
                session(['cart.products' => unserialize($cart->content)]);
            }
        }
    }
}
