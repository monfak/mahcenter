<?php

namespace App\Http\Controllers\Admin;

use App\Events\OrderSent;
use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;
use Sms;

class OrderController extends Controller
{
    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:orders-manage');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view()->first(['admin.orders.index']);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $users = User::query()->get();
        $products = Product::query()->published()->get();
        return view('admin.orders.create', compact('users', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('order::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Order $order
     * @return Response
     */
    public function edit(Order $order)
    {
        $order->load('products', 'payments', 'address.city.province', 'notes.user');
        if(!$order->checked) {
            $order->checked = true;
            $order->save();
        }
        $address = $order->address;
        return view('admin.orders.edit', compact('order', 'address'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Order $order
     * @return Response
     */
    public function update(Request $request, Order $order)
    {
        if (in_array($request->status, [0, 1, 2, 3, 4, 5])) {
            if($request->status == Order::STATUS_SENT && $order->status != Order::STATUS_SENT) {
                $user = $order->user;
                $message = 'سفارش شما در وضعیت ارسال شده قرار گرفت.';
                //if($order->mobile ?? $user->mobile) {
                    // Sms::send($message, $user->mobile);
                //}
            }
            $order->status = $request->status;
            $order->save();
            success("سفارش مورد نظر با موفقیت بروزرسانی گردید.");
        }
        return redirect()->route('admin.orders.index');
    }
    
    /**
     * Add note to an order.
     * @param Request $request
     * @param Order $order
     * @return Response
     */
    public function note(Request $request, Order $order)
    {
        if ($request->input('content')) {
            $noteData = $request->only(['content']);
            $noteData['user_id'] = auth()->id();
            if($request->hasfile('attachment')) {
                $date = date('Y/m');
                foreach($request->file('attachment') as $key => $attachment)
                {
                    $name = Str::random(12);
                    if($attachment->storeAs('public/images/attachments/' . $date, $name . '.' . $attachment->extension()))
                    {
                        $noteData['attachments'] = 'storage/images/attachments/' . $date . '/' . $name . '.' . $attachment->extension();
                    }
                }
            }
            $order->notes()->save(new Note($noteData));
            success("یادداشت شمابرای سفارش مورد نظر با موفقیت ثبت گردید.");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param  Request  $request
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data   = $request->all();
        $order  = Order::findOrFail($id);

        if ( isset($data['delete'] ))
        {
            $order->delete();
        }

        success();
        return redirect()->route('admin.orders.index');
    }

     public function ajax(Request $request)
    {
        if (!$request->ajax())
        {
            abort(404);
        }

        $orders=Order::with('user')->select()->orderBy('created_at',"DESC");
        return Datatables::of($orders)
            ->setTotalRecords($orders->count())
        	->editColumn('first_name', function ($order) {
                return view('admin.orders.partials.first_name', compact('order'));

            })
            ->editColumn('last_name', function ($order) {
                return view('admin.orders.partials.last_name', compact('order'));
            })
            ->editColumn('checked', function ($order) {
                return view('admin.orders.partials.checked', compact('order'));
            })
            ->addColumn('action', function ($order) {
                return view('admin.orders.partials.actions', compact('order'));
            })
            ->editColumn('created_at', function ($order) {
                return view('admin.orders.partials.created_at', compact('order'));
            })
            ->editColumn('tracking_code', function ($order) {
                return view('admin.orders.partials.tracking_code', compact('order'));
            })
            ->editColumn('total_price', function ($order) {
                return view('admin.orders.partials.total_price', compact('order'));
            })
            ->rawColumns(['checked', 'action'])
            ->make(true);
    }
}
