<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;
use DB;
use Yajra\DataTables\DataTables;

class LogController extends Controller
{
    /**
     * LogController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:logs-manage');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $logs = Activity::query();
            if($request->input('userName')) {
                $usersIds = User::query()->where('name', 'like', '%' . $request->input('userName') . '%')->pluck('id')->toArray();
                $logs->whereIn('causer_id', $usersIds);
            }
            return Datatables::of($logs)
                ->setTotalRecords($logs->count())
                ->editColumn('log_name', function ($log) {
                    return view('admin.logs.partials.datatables.log_name', compact('log'));
                })
                ->editColumn('description', function ($log) {
                    return view('admin.logs.partials.datatables.description', compact('log'));
                })
                ->addColumn('causer', function ($log) {
                    return view('admin.logs.partials.datatables.causer', compact('log'));
                })
                ->addColumn('heading', function ($log) {
                    return view('admin.logs.partials.datatables.heading', compact('log'));
                })
                ->editColumn('created_at', function ($log) {
                    return view('admin.logs.partials.datatables.created_at', compact('log'));
                })
                ->addColumn('actions', function ($log) {
                    return view('admin.logs.partials.datatables.actions', compact('log'));
                })
                ->rawColumns(['created_at', 'status', 'actions'])
                ->make(true);
        }
        return view('admin.logs.index');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param  Product  $product
     * 
     * @return \Illuminate\Http\Response
     */
    public function products(Request $request, Product $product)
    {
        if($request->ajax()) {
            $logs = Activity::query()->where('subject_type', 'App\Models\Product')->where('subject_id', $product->id);
            return Datatables::of($logs)
                ->setTotalRecords($logs->count())
                ->addColumn('causer', function ($log) {
                    return view('admin.logs.partials.datatables.causer', compact('log'));
                })
                ->editColumn('log_name', function ($log) {
                    return view('admin.logs.partials.datatables.log_name', compact('log'));
                })
                ->editColumn('description', function ($log) {
                    return view('admin.logs.partials.datatables.description', compact('log'));
                })
                ->editColumn('created_at', function ($log) {
                    return view('admin.logs.partials.datatables.created_at', compact('log'));
                })
                ->addColumn('actions', function ($log) {
                    return view('admin.logs.partials.datatables.actions', compact('log'));
                })
                ->rawColumns(['created_at', 'status', 'actions'])
                ->make(true);
        }
        return view('admin.logs.products', compact('product'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param  User  $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function users(Request $request, User $user)
    {
        if($request->ajax()) {
            $logs = Activity::query()->where('causer_type', 'App\Models\User')->where('causer_id', $user->id);
            return Datatables::of($logs)
                ->setTotalRecords($logs->count())
                ->addColumn('heading', function ($log) {
                    return view('admin.logs.partials.datatables.heading', compact('log'));
                })
                ->editColumn('log_name', function ($log) {
                    return view('admin.logs.partials.datatables.log_name', compact('log'));
                })
                ->editColumn('description', function ($log) {
                    return view('admin.logs.partials.datatables.description', compact('log'));
                })
                ->editColumn('created_at', function ($log) {
                    return view('admin.logs.partials.datatables.created_at', compact('log'));
                })
                ->addColumn('actions', function ($log) {
                    return view('admin.logs.partials.datatables.actions', compact('log'));
                })
                ->rawColumns(['created_at', 'status', 'actions'])
                ->make(true);
        }
        return view('admin.logs.users', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $log = Activity::findOrFail($id);
        return view('admin.logs.show', compact('log'));
    }
}