<?php

use App\Jobs\AssignGuestOrdersToUsers;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('assign:guest-orders', function () {
    AssignGuestOrdersToUsers::dispatch();
})->describe('Assign guest orders to existing or new users');

Schedule::command('assign:guest-orders')->hourly();