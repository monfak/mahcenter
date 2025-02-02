<?php

namespace App\Http\Controllers\Admin;

use App\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Manufacturer;
use App\Services\ActivityLogService;
use App\Http\Requests\StoreManufacturer;
use App\Http\Requests\UpdateManufacturer;

class ManufacturerController extends Controller
{
    protected $activityLogService;
    
    /**
     * ManufacturerController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:manufacturers-manage');
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $manufacturers = Manufacturer::latest('sort_order')->get();
        return view('admin.manufacturers.index', compact('manufacturers'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin.manufacturers.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreManufacturer $request
     * @return Response
     */
    public function store(StoreManufacturer $request)
    {
        $manufacturerData = $request->only(['name', 'slug', 'sort_order', 'title', 'description', 'title', 'meta_description', 'twitter_title', 'twitter_description', 'canonical']);
        $manufacturerData['is_nofollow'] = $request->input('is_nofollow', false);
        $manufacturerData['is_noindex'] = $request->input('is_noindex', false);
        if ($request->hasFile('logo')) {
            $name = pathinfo($request->logo->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->logo->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->logo->getClientOriginalExtension())) {
                $manufacturerData['logo'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->logo->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('og_image')) {
            $name = pathinfo($request->og_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->og_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->og_image->getClientOriginalExtension())) {
                $manufacturerData['og_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->og_image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('twitter_image')) {
            $name = pathinfo($request->twitter_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->twitter_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->twitter_image->getClientOriginalExtension())) {
                $manufacturerData['twitter_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->twitter_image->getClientOriginalExtension();
            }
        }
        $manufacturer = Manufacturer::create($manufacturerData);
        $log = $this->activityLogService->init('تولید کننده', 'created')->prepare($manufacturer)->finalize()->save();

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "تولید کننده $manufacturer->name با موفقیت ایجاد گردید."
        ]);

        return redirect()->route('admin.manufacturers.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('manufacturer::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param integer $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        return view('admin.manufacturers.edit', compact('manufacturer'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateManufacturer $request
     * @return Response
     */
    public function update(UpdateManufacturer $request, $id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        $log = $this->activityLogService->init('تولید کننده', 'updated')->prepare($manufacturer, 'old');

        $manufacturerData = $request->only(['name', 'slug', 'sort_order', 'title', 'description', 'title', 'meta_description', 'twitter_title', 'twitter_description', 'canonical']);
        $manufacturerData['is_nofollow'] = $request->input('is_nofollow', false);
        $manufacturerData['is_noindex'] = $request->input('is_noindex', false);
        if ($request->hasFile('logo')) {
            $name = pathinfo($request->logo->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->logo->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->logo->getClientOriginalExtension())) {
                $manufacturerData['logo'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->logo->getClientOriginalExtension();
            }
        } elseif($request->input('remove-logo')) {
            $manufacturer->logo = null;
        }
        if ($request->hasFile('og_image')) {
            $name = pathinfo($request->og_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->og_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->og_image->getClientOriginalExtension())) {
                $manufacturerData['og_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->og_image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('twitter_image')) {
            $name = pathinfo($request->twitter_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->twitter_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->twitter_image->getClientOriginalExtension())) {
                $manufacturerData['twitter_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->twitter_image->getClientOriginalExtension();
            }
        }

        $manufacturer->update($manufacturerData);
        $log->prepare($manufacturer)->finalize()->save();

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "$manufacturer->name با موفقیت آپدیت شد."
        ]);

        return redirect()->route('admin.manufacturers.index');
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
        $manufacturer = Manufacturer::findOrFail($id);
        $log = $this->activityLogService->init('تولید کننده', 'deleted')->prepare($manufacturer, 'old')->finalize()->save();

        if(isset($data['delete']))
        {
            $manufacturer->delete();
        }

        success();

        return redirect()->route('admin.manufacturers.index');
    }
}
