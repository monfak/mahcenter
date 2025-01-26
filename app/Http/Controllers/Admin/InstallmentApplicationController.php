<?php

namespace App\Http\Controllers\Admin;

use App\Models\InstallmentPlan;
use App\Models\InstallmentApplication;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InstallmentApplicationController extends Controller
{
    /**
     * InstallmentApplicationController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:installments-applications');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $applications = InstallmentApplication::with('plan')->latest()->paginate();
        return view('admin.installments.applications.index', compact('applications'));
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(InstallmentApplication $application)
    {
        $application->load('plan');
        $application->update(['seen_at' => now()]);
        return view('admin.installments.applications.show', compact('application'));
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
        $plan = InstallmentApplication::findOrFail($id);
        $plan->delete();
        success('درخواست اقساط با موفقیت حذف گردید.');
        return redirect()->route('admin.installments.plans.index');
    }
}
