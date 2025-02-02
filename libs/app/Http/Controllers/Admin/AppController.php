<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\InstallmentApplication;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\Ticket;
use Carbon\Carbon;

class AppController extends Controller
{
    /**
     * AppController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:access-dashboard');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $totalOrders = Order::query()->count();
        $totalUsers = User::query()->count();
        $totalProducts = Product::query()->count();
        $totalCategories = Category::query()->count();
        $totalTickets = Ticket::query()->count();
        $totalReviews = Review::query()->count();
        $totalComments = Comment::query()->count();
        $totalOrdersAmountLastWeek = Order::query()->lastDays(7)->whereIn('status', [2, 3, 5])->sum('total_price');
        $totalOrdersAmountWeekBefore = Order::query()->lastDays(14, 7)->whereIn('status', [2, 3, 5])->sum('total_price');
        $growthLastWeek = $totalOrdersAmountWeekBefore != 0 
            ? abs(($totalOrdersAmountLastWeek - $totalOrdersAmountWeekBefore) / $totalOrdersAmountWeekBefore) * 100 
            : null;
        $isGrowthLastWeek = $totalOrdersAmountLastWeek >= $totalOrdersAmountWeekBefore;
        $totalOrdersAmountLastMonth = Order::query()->lastDays(30)->whereIn('status', [2, 3, 5])->sum('total_price');
        $totalOrdersAmountMonthBefore = Order::query()->lastDays(60, 30)->whereIn('status', [2, 3, 5])->sum('total_price');
        $growthLastMonth = $totalOrdersAmountMonthBefore != 0 
            ? abs(($totalOrdersAmountLastMonth - $totalOrdersAmountMonthBefore) / $totalOrdersAmountMonthBefore) * 100 
            : null;
        $isGrowthLastMonth = $totalOrdersAmountLastMonth >= $totalOrdersAmountMonthBefore;
        $totalOrdersAmountLastYear  = Order::query()->lastDays(365)->whereIn('status', [2, 3, 5])->sum('total_price');
        $totalOrdersAmountYearBefore = Order::query()->lastDays(730, 365)->whereIn('status', [2, 3, 5])->sum('total_price');
        $growthLastYear = $totalOrdersAmountYearBefore != 0 
            ? abs(($totalOrdersAmountLastYear - $totalOrdersAmountYearBefore) / $totalOrdersAmountYearBefore) * 100 
            : null;
        $isGrowthLastYear = $totalOrdersAmountLastYear >= $totalOrdersAmountYearBefore;
        $totalOrdersAmount          = Order::query()->whereIn('status', [2, 3, 5])->sum('total_price');
        $totalInstallmentApplications = InstallmentApplication::query()->count();
        $latestOrders               = Order::query()->with('user')->latest()->take(10)->get();
        $latestProducts             = Product::query()->latest()->take(6)->get();
        $latestReviews              = Review::query()->with('user', 'parent')->latest()->take(6)->get();
        $latestTickets              = Ticket::query()->with('user')->latest()->take(6)->get();
        $latestUsers                = User::query()->latest()->take(10)->get();
        $notCompletedProducts       = Product::query()
                                        ->whereNull('alt')
                                        ->orWhereNull('title')
                                        ->orWhereNull('meta_description')
                                        ->orWhere('is_noindex', true)
                                        ->orWhere('status', false)
                                        ->select(['alt', 'name', 'slug', 'title', 'meta_description', 'is_noindex', 'status'])
                                        ->get();
        
        $monthlySalesData = [];
        $monthlySuccessfulSalesData = [];
        $months = []; 

        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = jdate($month)->format('F');
            $monthlySalesData[] = (int) number_format(Order::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('total_price'), 0, '', '') / 1000000;
            $monthlySuccessfulSalesData[] = (int) number_format(Order::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->whereIn('status', [2, 3, 5])
                ->sum('total_price'), 0, '', '') / 1000000;
        }

        return view('admin.app.index', compact(
            'totalOrders',
            'totalUsers',
            'totalProducts',
            'totalCategories',
            'totalTickets',
            'totalReviews',
            'totalComments',
            'totalInstallmentApplications',
            'latestOrders',
            'latestProducts',
            'latestReviews',
            'latestTickets',
            'latestUsers',
            'notCompletedProducts',
            'totalOrdersAmountLastWeek',
            'growthLastWeek',
            'isGrowthLastWeek',
            'totalOrdersAmountLastMonth',
            'growthLastMonth',
            'isGrowthLastMonth',
            'totalOrdersAmountLastYear',
            'growthLastYear',
            'isGrowthLastYear',
            'totalOrdersAmount',
            'months',
            'monthlySalesData',
            'monthlySuccessfulSalesData'));
    }
}
