<?php

namespace App\Http\Controllers\Admin;

use App\Models\InstallmentPlan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Services\ActivityLogService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InstallmentPlanController extends Controller
{
    protected $activityLogService;
    
    /**
     * InstallmentPlanController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:installments-plans');
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $plans = InstallmentPlan::latest()->paginate();
        return view('admin.installments.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin.installments.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreArticle $request
     * @return Response
     */
    public function store(Request $request)
    {
        $planData = $request->only(['name', 'sort_order']);
        $planData['is_active'] = $request->input('is_active', false);
        $plan = InstallmentPlan::create($planData);
        $log = $this->activityLogService->init('پلن اقساط', 'created')->prepare($plan)->finalize()->save();
        success('پلن با موفقیت ایجاد گردید.');
        return redirect()->route('admin.installments.plans.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param InstallmentPlan $installmentPlan
     * @return Response
     */
    public function edit(InstallmentPlan $plan)
    {
        return view('admin.installments.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateArticle $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $plan = InstallmentPlan::findOrFail($id);
        $log = $this->activityLogService->init('پلن اقساط', 'updated')->prepare($plan, 'old');
        $plan->name         = $request->input('name');
        $plan->sort_order   = $request->input('sort_order');
        $plan->is_active    = $request->input('is_active', false);
        $plan->save();
        $log->prepare($plan)->finalize()->save();
        success('پلن با موفقیت آپدیت شد.');
        return redirect()->route('admin.installments.plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Integer $id Identifier of the article
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $plan = InstallmentPlan::findOrFail($id);
        $log = $this->activityLogService->init('پلن اقساط', 'deleted')->prepare($plan, 'old');
        $log->prepare($plan)->finalize()->save();
        $plan->delete();
        success('پلن اقساط با موفقیت حذف گردید.');
        return redirect()->route('admin.installments.plans.index');
    }
}
