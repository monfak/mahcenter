<?php

namespace App\Providers;

use App\Http\Views\Composers\AdminMenuComposer;
use App\Http\Views\Composers\AuthComposer;
use App\Http\Views\Composers\CustomerServicesComposer;
use App\Http\Views\Composers\HeaderMenuComposer;
use App\Http\Views\Composers\ItemInBasketsComposer;
use App\Http\Views\Composers\MenuCategoriesComposer;
use App\Http\Views\Composers\NotificationComposer;
use App\Http\Views\Composers\OpenTicketsComposer;
use App\Http\Views\Composers\PanelSidebarComposer;
use App\Http\Views\Composers\PendingReviewsComposer;
use App\Http\Views\Composers\SaleGuidesComposer;
use App\Http\Views\Composers\SettingsComposer;
use App\Http\Views\Composers\UncheckedOrdersComposer;
use App\Http\Views\Composers\UnreadTicketsComposer;
use App\Http\Views\Composers\UnseenInstallmentsComposer;
use Illuminate\Support\ServiceProvider;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', AuthComposer::class);
        view()->composer('*', SettingsComposer::class);

        view()->composer('admin.*', UncheckedOrdersComposer::class);
        view()->composer('admin.*', OpenTicketsComposer::class);
        view()->composer('admin.*', PendingReviewsComposer::class);
        view()->composer('admin.*', UnseenInstallmentsComposer::class);

        view()->composer('admin.layouts.sidebar', AdminMenuComposer::class);

        view()->composer('frontend.layouts.sidebar', PanelSidebarComposer::class);
        view()->composer('frontend.layouts.sidebar', UnreadTicketsComposer::class);

        view()->composer('frontend.layouts.header', ItemInBasketsComposer::class);
        view()->composer('frontend.layouts.header', NotificationComposer::class);
        view()->composer('frontend.layouts.header', MenuCategoriesComposer::class);
        view()->composer('frontend.layouts.header', HeaderMenuComposer::class);

        view()->composer('frontend.layouts.footer', ItemInBasketsComposer::class);
        view()->composer('frontend.layouts.footer', SaleGuidesComposer::class);
        view()->composer('frontend.layouts.footer', CustomerServicesComposer::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
