<?php

use App\Http\Controllers\Panel\AddressController;
use App\Http\Controllers\Panel\AccountController;
use App\Http\Controllers\Panel\ReviewController;
use App\Http\Controllers\Panel\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/', [AccountController::class, 'index'])->name('index');
Route::get('edit', [AccountController::class, 'edit'])->name('edit');
Route::patch('update', [AccountController::class, 'update'])->name('update');
Route::get('password', [AccountController::class, 'password'])->name('password');
Route::patch('password', [AccountController::class, 'updatePassword'])->name('password.update');
//Route::get('address', [AccountController::class, 'address'])->name('address');
//Route::patch('address', [AccountController::class, 'updateAddress'])->name('address.update');
Route::get('order', [AccountController::class, 'order'])->name('order');
Route::get('newsletter', [AccountController::class, 'newsletter'])->name('newsletter');
Route::patch('newsletter', [AccountController::class, 'updateNewsletter'])->name('newsletter.update');
Route::resource('addresses', AddressController::class)->except('show');
Route::get('address', [AddressController::class, 'index']);
Route::resource('tickets', TicketController::class);
