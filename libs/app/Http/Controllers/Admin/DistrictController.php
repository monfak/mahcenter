<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\City;
use App\Http\Requests\DistrictRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DistrictController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:districts-manage');
    }
    
    public function index()
    {
           return view('admin.districts.index');
    }

    public function ajax()
    {
        $districts = District::query()->with('city');
        return Datatables::of($districts)
            ->setTotalRecords($districts->count())
            ->orderColumn('created_at', 'created_at $1')
            ->addColumn('city', function ($district) {
                return view('admin.districts.partials.city', compact('district'));
            })
            ->editColumn('price_large', function ($district) {
                return view('admin.districts.partials.price_large', compact('district'));
            })
            ->editColumn('price_small', function ($district) {
                return view('admin.districts.partials.price_small', compact('district'));
            })
            ->editColumn('updated_at', function ($district) {
                return view('admin.districts.partials.updated_at', compact('district'));
            })
            ->addColumn('actions', function ($district) {
                return view('admin.districts.partials.actions', compact('district'));
            })
            ->rawColumns(['price_large', 'price_small', 'updated_at', 'actions'])
            ->make(true);
    }


    public function create(Request $request)
    {
        $cities = City::query()->pluck('name', 'id');
        return view('admin.districts.create', compact('cities'));
    }


    public function store(DistrictRequest $request)
    {
        $district = District::query()->create($request->validated());
        success('محله ' . $district->name . ' با موفقیت ایجاد شد.');
        return redirect()->route('admin.districts.index');
    }

    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param District $district
     * @return Response
     */
    public function edit(District $district)
    {
        $cities = City::query()->pluck('name', 'id');
        return view('admin.districts.edit', compact('district', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DistrictRequest  $request
     * @param  District  $district
     * @return Response
     */
    public function update(DistrictRequest $request, District $district)
    {
        $district->update($request->validated());
        success('محله ' . $district->name . ' با موفقیت آپدیت شد.');
        return redirect()->route('admin.districts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Integer $id Identifier of the city
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $district = District::findOrFail($id);
        $district->delete();
        success();
        return redirect()->route('admin.districts.index');
    }
}
