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

class UnitController extends Controller
{
    /**
     * UnitController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:units-manage');
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
        $unit = Unit::findOrFail($id);
        $unit->name = $request->input('name');
        $unit->save();
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
        if ( isset($data['delete'] ))
        {
            $unit->delete();
        }
        doneMessage();
        return redirect()->route('admin.units.index');
    }
}
