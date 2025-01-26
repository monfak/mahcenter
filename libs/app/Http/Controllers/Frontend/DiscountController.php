<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Discount;

class DiscountController extends Controller
{
    public function show(Discount $discount)
    {
        $products = $discount->activeProducts()->latest()->paginate(16);

        return view('frontend.discount',compact('products', 'discount'));
    }
}
