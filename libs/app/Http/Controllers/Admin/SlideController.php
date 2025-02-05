<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SlideRequest;
use App\Models\Slide;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ActivityLogService;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class SlideController extends Controller
{
    protected $activityLogService;
    
    /**
     * SlideController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:slider-manage');
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $slides = Slide::latest()->paginate();
        return view('admin.slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * This action saves a slide and its items into the database.
     *
     * @param  \App\Http\Requests\SlideRequest  $request
     * @return Response
     */
    public function store(SlideRequest $request)
    {
        $sliderData = $request->only(['heading', 'alt', 'url', 'content', 'sort_order']);
        $sliderData['is_active'] = $request->input('is_active', false);
        if($request->hasfile('image'))
        {
            $date   = date('Y/m');
            $name = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            if($request->image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->image->getClientOriginalExtension()))
            {
                $sliderData['image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->image->getClientOriginalExtension();
            }
        }
        $slider = Slide::create($sliderData);
        $log = $this->activityLogService->init('اسلایدر', 'created')->prepare($slider)->finalize()->save();

        success('اسلاید با موفقیت به اسلایدر اضافه شد.');
        return redirect()->route('admin.slides.index');
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
     * @param  \App\Models\Slide  $slide
     * @return Response
     */
    public function edit(Slide $slide)
    {
        return view('admin.slides.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SlideRequest  $request
     * @param  \App\Models\Slide  $slide
     * @return Response
     */
    public function update(SlideRequest $request, Slide $slide)
    {
        $log = $this->activityLogService->init('اسلایدر', 'updated')->prepare($slide, 'old');
        $sliderData = $request->only(['heading', 'alt', 'url', 'content', 'sort_order']);
        $sliderData['is_active'] = $request->input('is_active', false);
        if($request->hasfile('image'))
        {
            $date   = date('Y/m');
            $name = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            if($request->image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->image->getClientOriginalExtension()))
            {
                $sliderData['image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->image->getClientOriginalExtension();
            }
        }
        $slide->update($sliderData);
        $log->prepare($slide)->finalize()->save();
        success("اسلاید به موفقیت به اسلایدر اضافه شد.");
        return redirect()->route('admin.slides.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param integer $id
     * @return Response
     */
    public function destroy($id)
    {
        $slider = Slide::findOrFail($id);
        $log = $this->activityLogService->init('اسلایدر', 'deleted')->prepare($slider, 'old')->finalize()->save();
        $slider->delete();
        success('اسلاید با موفقیت حذف شد.');
        return redirect()->route('admin.slides.index');
    }
}
