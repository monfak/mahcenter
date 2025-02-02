<?php

namespace App\Http\Controllers\Admin;

use App\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Redirect;
use App\Http\Requests\StoreRedirect;
use App\Http\Requests\UpdateRedirect;
use App\Services\ActivityLogService;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class RedirectController extends Controller
{
    protected $activityLogService;
    
    /**
     * RedirectController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:redirects-manage');
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $redirects = Redirect::query();
            return Datatables::of($redirects)
                ->setTotalRecords($redirects->count())
                ->editColumn('created_at', function ($redirect) {
                    return view('admin.redirects.partials.datatables.created_at', compact('redirect'));
                })
                ->addColumn('actions', function ($redirect) {
                    return view('admin.redirects.partials.datatables.actions', compact('redirect'));
                })
                ->rawColumns(['created_at', 'type', 'actions'])
                ->make(true);
        }
        return view('admin.redirects.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin.redirects.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreRedirect $request
     * @return Response
     */
    public function store(StoreRedirect $request)
    {
        $redirect = Redirect::create($request->only(['old', 'url', 'type']));
        $log = $this->activityLogService->init('ریدایرکت', 'created')->prepare($redirect)->finalize()->save();
        success('ریدایرکت مورد نظر با موفقیت ایجاد شد.');
        return redirect()->route('admin.redirects.index');
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
     * @param  Redirect  $redirect
     * @return Response
     */
    public function edit(Redirect $redirect)
    {
        return view('admin.redirects.edit', compact('redirect'));
    }

    /**
     * Update the specified resource in storage.
     * @param  UpdateRedirect  $request
     * @param  Redirect  $redirect
     * @return Response
     */
    public function update(UpdateRedirect $request, Redirect $redirect)
    {
        $log = $this->activityLogService->init('ریدایرکت', 'updated')->prepare($redirect, 'old');
        $redirect->update($request->only(['old', 'url', 'type']));
        $log->prepare($redirect)->finalize()->save();
        success('ریدایرکت با موفقیت آپدیت شد.');
        return redirect()->route('admin.redirects.index');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param Request $request
     * @param Integer $id Identifier of the redirect
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $redirect = Redirect::findOrFail($id);
        $log = $this->activityLogService->init('ریدایرکت', 'deleted')->prepare($redirect, 'old')->finalize()->save();
        $redirect->delete();
        success();
        return redirect()->route('admin.redirects.index');
    }
}
