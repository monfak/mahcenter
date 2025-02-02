<?php

namespace App\Http\Controllers\Admin;

use App\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Unit;
use App\Http\Requests\StoreUnit;
use App\Http\Requests\UpdateUnit;
use App\Services\ActivityLogService;

class UnitController extends Controller
{
    protected $activityLogService;
    
    /**
     * UnitController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:units-manage');
        $this->activityLogService = $activityLogService;
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $units = Unit::latest('id')->paginate();
        return view()->first(['admin.units.index', 'unit::index'], compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view()->first(['admin.units.create', 'unit::create']);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreUnit $request
     * @return Response
     */
    public function store(StoreUnit $request)
    {
        $unit = Unit::create($request->only(['name']));
        $log = $this->activityLogService->init('واحد', 'created')->prepare($unit)->finalize()->save();
        doneMessage("واحد شمارش $unit->name با موفقیت ایجاد گردید.");
        return redirect()->route('admin.units.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('unit::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param integer $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('admin.units.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateUnit $request
     * @return Response
     */
    public function update(UpdateUnit $request, $id)
    {
        $log = $this->activityLogService->init('واحد', 'updated')->prepare($unit, 'old');
        $unit = Unit::findOrFail($id);
        $unit->name = $request->input('name');
        $unit->save();
        $log->prepare($unit)->finalize()->save();
        doneMessage("$unit->name با موفقیت آپدیت شد.");
        return redirect()->route('admin.units.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param integer $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $unit = Unit::findOrFail($id);
        $log = $this->activityLogService->init('واحد', 'deleted')->prepare($unit, 'old')->finalize()->save();
        if ( isset($data['delete'] ))
        {
            $unit->delete();
        }
        doneMessage();
        return redirect()->route('admin.units.index');
    }
}
