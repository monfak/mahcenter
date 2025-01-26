<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('get_settings')) {
    /**
     * Get all autoload settings
     */
    function get_settings() {
        return Cache::remember('site-settings', now()->addMinutes(5), function () {
            return Setting::query()->autoload()->pluck('value', 'key');
        });
    }
}

if (!function_exists('get_setting')) {
    /**
     * Get a specific setting
     */
    function get_setting($key) {
        return Cache::remember($key, now()->addMinutes(5), function () use($key) {
            return Setting::query()->where('key', $key)->value('value');
        });
    }
}
