<?php

namespace App\Http\Controllers\Admin;

use App\Events\OrderSent;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;
use Sms;

class CartController extends Controller
{
    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:carts-manage');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $carts = Cart::query()->with('user');
            return Datatables::of($carts)
                ->setTotalRecords($carts->count())
            	->editColumn('name', function ($cart) {
                    return view('admin.carts.partials.name', compact('cart'));
                })
                ->editColumn('total_price', function ($cart) {
                    return view('admin.carts.partials.total_price', compact('cart'));
                })
                ->editColumn('mobile', function ($cart) {
                    return view('admin.carts.partials.mobile', compact('cart'));
                })
                ->editColumn('session_id', function ($cart) {
                    return view('admin.carts.partials.session_id', compact('cart'));
                })
                ->addColumn('products', function ($cart) {
                    return view('admin.carts.partials.products', compact('cart'));
                })
                ->addColumn('actions', function ($cart) {
                    return view('admin.carts.partials.actions', compact('cart'));
                })
                ->editColumn('created_at', function ($cart) {
                    return view('admin.carts.partials.created_at', compact('cart'));
                })
                ->editColumn('updated_at', function ($cart) {
                    return view('admin.carts.partials.updated_at', compact('cart'));
                })
                ->rawColumns(['products', 'mobile', 'session_id', 'actions'])
                ->make(true);
        }
        return view('admin.carts.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Cart $cart)
    {
        $cart->load('items.product', 'address.city.province', 'user');
        return view('admin.carts.show', compact('cart'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Order $order
     * @return Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Cart $cart
     * @return Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param  Request  $request
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data   = $request->all();
        $cart  = Cart::findOrFail($id);
        if(isset($data['delete']))
        {
            $cart->delete();
        }
        success();
        return redirect()->route('admin.carts.index');
    }
}
