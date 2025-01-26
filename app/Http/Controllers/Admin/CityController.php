<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use App\Http\Requests\CityRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CityController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:cities-manage');
    }
    
    public function index()
    {
           return view('admin.cities.index');
    }

    public function ajax()
    {
        $cities = City::query()->with('province');
        return Datatables::of($cities)
            ->setTotalRecords($cities->count())
            ->orderColumn('created_at', 'created_at $1')
            ->addColumn('province', function ($city) {
                return view('admin.cities.partials.province', compact('city'));
            })
            ->editColumn('price_large', function ($city) {
                return view('admin.cities.partials.price_large', compact('city'));
            })
            ->editColumn('price_small', function ($city) {
                return view('admin.cities.partials.price_small', compact('city'));
            })
            ->editColumn('updated_at', function ($city) {
                return view('admin.cities.partials.updated_at', compact('city'));
            })
            ->addColumn('actions', function ($city) {
                return view('admin.cities.partials.actions', compact('city'));
            })
            ->rawColumns(['price_large', 'price_small', 'updated_at', 'actions'])
            ->make(true);
    }


    public function create(Request $request)
    {
        $provinces = Province::query()->pluck('name', 'id');
        return view('admin.cities.create', compact('provinces'));
    }


    public function store(CityRequest $request)
    {
        $city = City::query()->create($request->validated());
        success('شهر ' . $city->name . ' با موفقیت ایجاد شد.');
        return redirect()->route('admin.cities.index');
    }

    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param City $city
     * @return Response
     */
    public function edit(City $city)
    {
        $provinces = Province::query()->pluck('name', 'id');
        return view('admin.cities.edit', compact('city', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CityRequest  $request
     * @param  City  $city
     * @return Response
     */
    public function update(CityRequest $request, City $city)
    {
        $city->update($request->validated());
        success('شهر ' . $city->name . ' با موفقیت آپدیت شد.');
        return redirect()->route('admin.cities.index');
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
        $city = City::findOrFail($id);
        $city->delete();
        success();
        return redirect()->route('admin.cities.index');
    }
}
