<?php

namespace App\Http\Controllers\Admin;

use App\Utilities\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Warranty;
use App\Services\ActivityLogService;
use App\Http\Requests\WarrantyRequest;
use App\Services\ActivityLogService;

class WarrantyController extends Controller
{
    protected $activityLogService;
    
    /**
     * ArticleController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:warranties-manage');
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $warranties = Warranty::latest()->paginate();
        return view('admin.warranties.index', compact('warranties'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin.warranties.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param WarrantyRequest $request
     * @return Response
     */
    public function store(WarrantyRequest $request)
    {
        $warrantyData = $request->only(['name', 'slug', 'content', 'title', 'description', 'price', 'twitter_title', 'twitter_description', 'canonical']);
        $warrantyData['is_nofollow'] = $request->input('is_nofollow', false);
        $warrantyData['is_noindex'] = $request->input('is_noindex', false);
        $warrantyData['is_active'] = $request->input('is_active', false);
        $warrantyData['show_in_home'] = $request->input('show_in_home', false);
        if($request->hasFile('image'))
        {
            $name = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            if($request->image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->image->getClientOriginalExtension()))
            {
                $warrantyData['image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('og_image')) {
            $name = pathinfo($request->og_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->og_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->og_image->getClientOriginalExtension())) {
                $warrantyData['og_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->og_image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('twitter_image')) {
            $name = pathinfo($request->twitter_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->twitter_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->twitter_image->getClientOriginalExtension())) {
                $warrantyData['twitter_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->twitter_image->getClientOriginalExtension();
            }
        }
        if($request->hasFile('logo'))
        {
            $name = pathinfo($request->logo->getClientOriginalName(), PATHINFO_FILENAME);
            if($request->logo->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->logo->getClientOriginalExtension()))
            {
                $warrantyData['logo'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->logo->getClientOriginalExtension();
            }
        }
        $warranty = Warranty::create($warrantyData);
        $log = $this->activityLogService->init('گارانتی', 'created')->prepare($warranty)->finalize()->save();
        success("گارانتی  {$warranty->name} با موفقیت ایجاد شد.");
        return redirect()->route('admin.warranties.index');
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
     * @param Warranty $warranty
     * @return Response
     */
    public function edit(Warranty $warranty)
    {
        return view('admin.warranties.edit', compact('warranty'));
    }

    /**
     * Update the specified resource in storage.
     * @param WarrantyRequest $request
     * @param int $id
     * @return Response
     */
    public function update(WarrantyRequest $request, $id)
    {
        $warranty = Warranty::query()->find($id);
        $log = $this->activityLogService->init('گارانتی', 'updated')->prepare($warranty, 'old');
        $warrantyData = $request->only(['name', 'slug', 'content', 'title', 'description', 'price', 'twitter_title', 'twitter_description', 'canonical']);
        $warrantyData['is_nofollow'] = $request->input('is_nofollow', false);
        $warrantyData['is_noindex'] = $request->input('is_noindex', false);
        $warrantyData['is_active'] = $request->input('is_active', false);
        $warrantyData['show_in_home'] = $request->input('show_in_home', false);
        if($request->hasFile('image'))
        {
            $name = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            if($request->image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->image->getClientOriginalExtension()))
            {
                $warrantyData['image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('og_image')) {
            $name = pathinfo($request->og_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->og_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->og_image->getClientOriginalExtension())) {
                $warrantyData['og_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->og_image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('twitter_image')) {
            $name = pathinfo($request->twitter_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->twitter_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->twitter_image->getClientOriginalExtension())) {
                $warrantyData['twitter_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->twitter_image->getClientOriginalExtension();
            }
        }
        if($request->hasFile('logo'))
        {
            $name = pathinfo($request->logo->getClientOriginalName(), PATHINFO_FILENAME);
            if($request->logo->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->logo->getClientOriginalExtension()))
            {
                $warrantyData['logo'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->logo->getClientOriginalExtension();
            }
        }
        $warranty->update($warrantyData);
        $log->prepare($warranty)->finalize()->save();
        success("گارانتی {$warranty->name} با موفقیت آپدیت شد.");
        return redirect()->route('admin.warranties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Integer $id Identifier of the warranty
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $warranty = Warranty::findOrFail($id);
        $log = $this->activityLogService->init('گارانتی', 'deleted')->prepare($warranty, 'old')->finalize()->save();
        $warranty->delete();
        success('گارانتی با موفقیت حذف گردید.');
        return redirect()->route('admin.warranties.index');
    }
}
