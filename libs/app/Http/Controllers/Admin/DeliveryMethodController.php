<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\DeliveryMethod;
use App\Http\Requests\DeliveryMethodRequest;
use App\Services\ActivityLogService;
use DB;
use Yajra\DataTables\DataTables;


class DeliveryMethodController extends Controller
{
    protected $activityLogService;
    
    /**
     * DeliveryMethodController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:delivery-methods-manage');
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $deliveryMethods = DeliveryMethod::query();
    
            return Datatables::of($deliveryMethods)
                ->setTotalRecords($deliveryMethods->count())
                ->editColumn('price', function ($deliveryMethod) {
                    return view('admin.delivery-methods.partials.price', compact('deliveryMethod'));
                })
                ->editColumn('is_active', function ($deliveryMethod) {
                    return view('admin.delivery-methods.partials.is_active', compact('deliveryMethod'));
                })
                ->addColumn('actions', function ($deliveryMethod) {
                    return view('admin.delivery-methods.partials.actions', compact('deliveryMethod'));
                })
                ->rawColumns(['created_at', 'is_active', 'actions'])
                ->make(true);
        }
        return view('admin.delivery-methods.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin.delivery-methods.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param DeliveryMethodRequest $request
     * @return Response
     */
    public function store(DeliveryMethodRequest $request)
    {
        $deliveryMethodData = $request->validated();
        $deliveryMethodData['has_carrige_forward'] = $request->input('has_carrige_forward', false);
        $deliveryMethodData['is_cover_all'] = $request->input('is_cover_all', false);
        $deliveryMethodData['is_active'] = $request->input('is_active', false);
        $deliveryMethod = DeliveryMethod::create($deliveryMethodData);
        $log = $this->activityLogService->init('روش ارسال', 'created')->prepare($deliveryMethod)->finalize()->save();
        success("روش ارسال $deliveryMethod->name ایجاد شد.");
        return redirect()->route('admin.delivery-methods.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(DeliveryMethod $deliveryMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param DeliveryMethod $deliveryMethod
     * @return Response
     */
    public function edit(DeliveryMethod $deliveryMethod)
    {
        return view('admin.delivery-methods.edit', compact('deliveryMethod'));
    }

    /**
     * Update the specified resource in storage.
     * @param DeliveryMethodRequest $request
     * @param DeliveryMethod $deliveryMethod
     * @return Response
     */
    public function update(DeliveryMethodRequest $request, DeliveryMethod $deliveryMethod)
    {
        $log = $this->activityLogService->init('روش ارسال', 'updated')->prepare($deliveryMethod, 'old');
        $deliveryMethodData = $request->validated();
        $deliveryMethodData['has_carrige_forward'] = $request->input('has_carrige_forward', false);
        $deliveryMethodData['is_cover_all'] = $request->input('is_cover_all', false);
        $deliveryMethodData['is_active'] = $request->input('is_active', false);
        $deliveryMethod->update($deliveryMethodData);
        $log->prepare($deliveryMethod)->finalize()->save();
        success("روش ارسال $deliveryMethod->name آپدیت شد.");
        return redirect()->route('admin.delivery-methods.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Integer $id Identifier of the delivery method
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $deliveryMethod = DeliveryMethod::findOrFail($id);
        $log = $this->activityLogService->init('روش ارسال', 'deleted')->prepare($deliveryMethod, 'old')->finalize()->save();
        $deliveryMethod->delete();
        success('روش ارسال با موفقیت حذف گردید.');
        return redirect()->route('admin.delivery-methods.index');
    }
}
