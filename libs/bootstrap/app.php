<?php

use App\Http\Middleware\CheckUserDetails;
use App\Http\Middleware\RedirectIfVerifiedTwoFactor;
use App\Http\Middleware\RedirectUrl;
use App\Http\Middleware\TwoFactorVerify;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->middleware(['web', 'auth'])->group(base_path('routes/admin.php'));
            Route::namespace('App\Http\Controllers\Panel')->prefix('panel')->name('panel.')->middleware(['web', 'auth'])->group(base_path('routes/panel.php'));
            Route::namespace('App\Http\Controllers\Frontend')->name('frontend.')->group(base_path('routes/frontend.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
            'twoFactor' => TwoFactorVerify::class,
            'twoFactorVerified' => RedirectIfVerifiedTwoFactor::class,
            'check.user.details' => CheckUserDetails::class,
        ]);
        $middleware->append(RedirectUrl::class);
        $middleware->validateCsrfTokens(except: [
            'payments/callback',
            'payments/sadad/request',
            'payments/sadad/callback'
    //        'https://mahcenter.com/payments/callback',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        if (request()->has('developer_token'))
        {
            config(['app.debug' => true]);
        }
    })->create();
