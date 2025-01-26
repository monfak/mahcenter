<?php

namespace App\Http\Controllers\Frontend;

use App\Models\InstallmentApplication;
use App\Models\InstallmentMonth;
use App\Models\InstallmentPercent;
use App\Models\InstallmentPlan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InstallmentController extends Controller
{
    public function index()
    {
        $middleBanner = Banner::with('items')->inPosition('middle_banner_installmentSale_page')->first();
        $secondBanner = Banner::with('items')->inPosition('second_banner_installmentSale_page')->first();
        $validationBanner = Banner::with('items')->inPosition('validation_documents_banner')->first();
        $percents = InstallmentPercent::query()->oldest('percent')->get();
        $months = InstallmentMonth::query()->oldest('month')->get();
        $plans = InstallmentPlan::query()->oldest('sort_order')->active()->pluck('name', 'id');
        $products = Product::installment()->where('stock', '>', 0)->where('price', '>', 0)->active()->get();
        return view('frontend.installment-sale', compact('middleBanner', 'secondBanner', 'validationBanner', 'percents', 'months', 'products', 'plans'));
    }

    public function store(Request $request)
    {
        $applicationData = $request->only(['name', 'plan_id', 'content']);
        $applicationData['mobile'] = to_latin_numbers($request->input('mobile'));
        $application = InstallmentApplication::create($applicationData);
        success("{$application->name} گرامی، درخواست شما ثبت شد، بزودی کارشناسان ما با شما تماس خواهند گرفت.");
        return redirect()->route('frontend.installments.index');
    }
}
