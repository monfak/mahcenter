<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * ReportController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:reports-manage');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $topUsers = DB::table('sales')
            ->join('orders', 'sales.order_id', '=', 'orders.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select(
                'users.id as user_id',
                'users.name',
                'users.created_at as joined_at',
                DB::raw('SUM(sales.quantity * sales.price) as total_spent'),
                DB::raw('COUNT(DISTINCT orders.id) as total_orders'),
                DB::raw('SUM(sales.quantity) as total_products')
            )
            ->groupBy('users.id')
            ->orderByDesc('total_spent')
            ->limit(10)
            ->get();
        return view('admin.reports.index', compact('topUsers'));
    }
}
