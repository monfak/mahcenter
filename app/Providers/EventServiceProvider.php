<?php

namespace App\Providers;

use App\Events\ArticlePublished;
use App\Events\CategoryPublished;
use App\Events\ManufacturerPublished;
use App\Events\OrderPaid;
use App\Events\SendOrder;
use App\Events\OrderSent;
use App\Events\OtpRequested;
use App\Events\PagePublished;
use App\Events\ProductPublished;
use App\Listeners\AddToCustomerClub;
use App\Listeners\SendOrderPaid;
use App\Listeners\SendOrderPlacedSmsListener;
use App\Listeners\SendOrderSent;
use App\Listeners\SendRegistrationSms;
use App\Listeners\SetDefaultRole;
use App\Listeners\SetDefaultTwoFactor;
use App\Listeners\SetTwoFactorUnverified;
use App\Listeners\SendMobileVerificationCode;
use App\Listeners\UpdateBlogSitemap;
use App\Listeners\UpdateCategorySitemap;
use App\Listeners\UpdateManufacturerSitemap;
use App\Listeners\UpdateIndexSitemap;
use App\Listeners\UpdatePageSitemap;
use App\Listeners\UpdateProductSitemap;
//use App\Listeners\SendRegistrationSms;
use App\Models\Article;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Page;
use App\Models\Product;
use App\Models\User;
use App\Observers\ArticleObserver;
use App\Observers\CategoryObserver;
use App\Observers\ManufacturerObserver;
use App\Observers\PageObserver;
use App\Observers\ProductObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            //SendEmailVerificationNotification::class,
            SetDefaultRole::class,
            AddToCustomerClub::class,
            SetDefaultTwoFactor::class,
            //SendRegistrationSms::class,
        ],
        Login::class => [
            SetTwoFactorUnverified::class,
        ],
        VerificationCodeRequested::class => [
            //SendMobileVerificationCode::class,
        ],
        OrderPaid::class => [
            SendOrderPaid::class,
        ],
        OrderSent::class => [
            SendOrderSent::class,
        ],
        OtpRequested::class => [
            SendRegistrationSms::class,
        ],
        ArticlePublished::class => [
            UpdateBlogSitemap::class,
            UpdateIndexSitemap::class,
        ],
        CategoryPublished::class => [
            UpdateCategorySitemap::class,
            UpdateIndexSitemap::class,
        ],
        ManufacturerPublished::class => [
            UpdateManufacturerSitemap::class,
            UpdateIndexSitemap::class,
        ],
        PagePublished::class => [
            UpdatePageSitemap::class,
            UpdateIndexSitemap::class,
        ],
        ProductPublished::class => [
            UpdateProductSitemap::class,
            UpdateIndexSitemap::class,
        ],
        OrderPlaced::class => [
            SendOrderPlacedSmsListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Article::observe(ArticleObserver::class);
        Category::observe(CategoryObserver::class);
        Manufacturer::observe(ManufacturerObserver::class);
        Page::observe(PageObserver::class);
        Product::observe(ProductObserver::class);
        User::observe(UserObserver::class);
    }
}
