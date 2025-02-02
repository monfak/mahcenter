<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Http\Requests\PaymentMethodRequest;
use App\Services\ActivityLogService;
use DB;
use Yajra\DataTables\DataTables;

class PaymentMethodController extends Controller
{
    protected $activityLogService;
    
    /**
     * PaymentMethodController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:payment-methods-manage');
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $paymentMethods = PaymentMethod::query();
    
            return Datatables::of($paymentMethods)
                ->setTotalRecords($paymentMethods->count())
                ->editColumn('type', function ($paymentMethod) {
                    return view('admin.payment-methods.partials.type', compact('paymentMethod'));
                })
                ->editColumn('is_active', function ($paymentMethod) {
                    return view('admin.payment-methods.partials.is_active', compact('paymentMethod'));
                })
                ->addColumn('actions', function ($paymentMethod) {
                    return view('admin.payment-methods.partials.actions', compact('paymentMethod'));
                })
                ->rawColumns(['created_at', 'is_active', 'actions'])
                ->make(true);
        }
        return view('admin.payment-methods.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin.payment-methods.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param PaymentMethodRequest $request
     * @return Response
     */
    public function store(PaymentMethodRequest $request)
    {
        $paymentMethodData = $request->validated();
        $paymentMethodData['is_active'] = $request->input('is_active', false);
        $paymentMethodData['is_removable'] = $request->input('is_removable', true);
        $paymentMethod = PaymentMethod::create($paymentMethodData);
        $log = $this->activityLogService->init('روش پرداخت', 'created')->prepare($paymentMethod)->finalize()->save();
        success("روش پرداخت $paymentMethod->name ایجاد شد.");
        return redirect()->route('admin.payment-methods.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PaymentMethod $paymentMethod
     * @return Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.payment-methods.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     * @param PaymentMethodRequest $request
     * @param PaymentMethod $paymentMethod
     * @return Response
     */
    public function update(PaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        $log = $this->activityLogService->init('روش پرداخت', 'updated')->prepare($paymentMethod, 'old');
        $paymentMethodData = $request->validated();
        $paymentMethodData['is_active'] = $request->input('is_active', false);
        $paymentMethod->update($paymentMethodData);
        $log->prepare($paymentMethod)->finalize()->save();
        success("روش پرداخت $paymentMethod->name آپدیت شد.");
        return redirect()->route('admin.payment-methods.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Integer $id Identifier of the payment method
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $paymentMethod = PaymentMethod::findOrFail($id);
        $log = $this->activityLogService->init('روش پرداخت', 'deleted')->prepare($paymentMethod, 'old')->finalize()->save();
        $paymentMethod->delete();
        success('روش پرداخت با موفقیت حذف گردید.');
        return redirect()->route('admin.payment-methods.index');
    }
}
