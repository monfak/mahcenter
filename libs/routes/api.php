<?php

use App\Http\Controllers\API\V1\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('v1/products', [ProductController::class, 'getProducts'])->name('api.products');
