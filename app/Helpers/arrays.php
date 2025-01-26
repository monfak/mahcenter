<?php

use Illuminate\Support\Arr;

if(!function_exists('array_pluck')) {
    function array_pluck($array, $value = null, $key = null) {
        return Arr::pluck($array, $value, $key);
    }
}
