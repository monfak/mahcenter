<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Http\Requests\ProvinceRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProvinceController extends Controller
{
    /**
     * ProvinceController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:provinces-manage');
    }
    
    public function index()
    {
           return view('admin.provinces.index');
    }

    public function ajax()
    {
        $provinces = Province::query();
        return Datatables::of($provinces)
            ->setTotalRecords($provinces->count())
            ->orderColumn('updated_at', 'updated_at $1')
            ->editColumn('price_large', function ($province) {
                return view('admin.provinces.partials.price_large', compact('province'));
            })
            ->editColumn('price_small', function ($province) {
                return view('admin.provinces.partials.price_small', compact('province'));
            })
            ->editColumn('updated_at', function ($province) {
                return view('admin.provinces.partials.updated_at', compact('province'));
            })
            ->addColumn('actions', function ($province) {
                return view('admin.provinces.partials.actions', compact('province'));
            })
            ->rawColumns(['price_large', 'price_small', 'created_at', 'actions'])
            ->make(true);
    }


    public function create()
    {
        return view('admin.provinces.create');
    }


    public function store(ProvinceRequest $request)
    {
        $provinceData = $request->only(['name', 'price_large', 'price_small']);
        $province = Province::query()->create($provinceData);
        success('استان ' . $province->name . ' با موفقیت ایجاد شد.');
        return redirect()->route('admin.provinces.index');
    }

    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Province $province
     * @return Response
     */
    public function edit(Province $province)
    {
        return view('admin.provinces.edit', compact('province'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProvinceRequest  $request
     * @param  Product  $product
     * @return Response
     */
    public function update(ProvinceRequest $request, Province $province)
    {
        $provinceData = $request->only(['name', 'price_large', 'price_small']);
        $province->update($provinceData);
        success('استان ' . $province->name . ' با موفقیت آپدیت شد.');
        return redirect()->route('admin.provinces.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Integer $id Identifier of the province
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $province = Province::findOrFail($id);
        $province->delete();
        success();
        return redirect()->route('admin.provinces.index');
    }
}
