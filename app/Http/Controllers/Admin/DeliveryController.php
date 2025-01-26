<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use App\Models\DeliveryDate;
use App\Http\Requests\UpdateDelivery;

class DeliveryController extends Controller
{
    /**
     * AddressController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:deliveries-manage');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $provinces = Province::oldest('id')->paginate();
        return view('admin.deliveries.index', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin.deliveries.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('delivery::show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param integer $id province
     * @return Response
     */
    public function edit($id)
    {
        $province   = Province::with('cities')->findOrFail($id);

        $lead_date = DeliveryDate::firstOrCreate(['lead_date' => date('Y-m-d')]);
        $cities = $lead_date->cities->pluck('id')->toArray();

        return view()->first(['admin.deliveries.edit', 'delivery::edit'], compact('province', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDelivery $request
     * @return Response
     */
    public function update(UpdateDelivery $request, $id)
    {
        if (!$request->ajax())
        {
            abort(404);
        }

        $province  = Province::findOrFail($id);
        $lead_date = DeliveryDate::firstOrCreate(['lead_date' => date('Y-m-d', $request->input('date'))]);

        if ($request->input('get'))
        {
            return response()->json(array_intersect($lead_date->cities->pluck('id')->toArray(), $province->cities->pluck('id')->toArray()));
        }

        $lead_date->cities()->sync($request->input('cities'));

        $province->price = $request->input('price');
        $province->save();

        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
