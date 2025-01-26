<?php

if (!function_exists('create_url')) {
    /**
     * Create a url if string is a path
     *
     * @param  string  $url
     * @return string
     */
    function create_url(string $url) {
        return filter_var($url, FILTER_VALIDATE_URL) ? $url : url($url);
    }
}