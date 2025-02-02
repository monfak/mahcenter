<?php

namespace App\Http\Controllers\Admin;

use App\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use App\Models\AttributeGroups;
use App\Models\FilterGroup;
use App\Models\Manufacturer;
use App\Services\ActivityLogService;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    protected $activityLogService;
    
    /**
     * CategoryController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:categories-manage');
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $categories = Category::query();
    
            return Datatables::of($categories)
                ->setTotalRecords($categories->count())
                ->editColumn('created_at', function ($category) {
                    return view('admin.categories.partials.label', compact('category'));
                })
                ->editColumn('created_at', function ($category) {
                    return view('admin.categories.partials.created_at', compact('category'));
                })
                ->editColumn('status', function ($category) {
                    return view('admin.categories.partials.status', compact('category'));
                })
                ->addColumn('actions', function ($category) {
                    return view('admin.categories.partials.actions', compact('category'));
                })
                ->rawColumns(['created_at', 'label', 'status', 'actions'])
                ->make(true);
        }
        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $parents        = Category::pluck('name','id')->toArray();
        $filters        = FilterGroup::get()->pluck('name_label','id')->toArray() ?? [];
        $attributes     = AttributeGroups::query()->pluck('name','id')->toArray() ?? [];
        $manufacturers  = Manufacturer::pluck('name', 'id')->toArray();
        return view('admin.categories.create', compact('parents', 'filters', 'attributes', 'manufacturers'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  StoreCategory $request
     * @return Response
     */
    public function store(StoreCategory $request)
    {
        $categoryData = $request->only(['name', 'title', 'label', 'slug', 'content', 'meta_description', 'parent_id', 'sort_order', 'discount', 'status', 'twitter_title', 'twitter_description', 'canonical', 'size_type']);
        $categoryData['user_id'] = auth()->user()->id;
        $categoryData['is_nofollow'] = $request->input('is_nofollow', false);
        $categoryData['is_noindex'] = $request->input('is_noindex', false);
        $categoryData['show_in_menu'] = $request->input('show_in_menu', false);
        $categoryData['has_slider'] = $request->input('has_slider', false);

        if($request->hasFile('icon')) {
            $name = pathinfo($request->icon->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->icon->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->icon->getClientOriginalExtension())) {
                $categoryData['icon'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->icon->getClientOriginalExtension();
            }
        }
        
        if ($request->hasFile('image')) {
            $name = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->image->getClientOriginalExtension())) {
                $categoryData['image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('og_image')) {
            $name = pathinfo($request->og_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->og_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->og_image->getClientOriginalExtension())) {
                $categoryData['og_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->og_image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('twitter_image')) {
            $name = pathinfo($request->twitter_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->twitter_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->twitter_image->getClientOriginalExtension())) {
                $categoryData['twitter_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->twitter_image->getClientOriginalExtension();
            }
        }

        $category = Category::create($categoryData);

        $category->filterGroups()->sync($request->input('filter_id'));
        $category->attributeGroups()->sync($request->input('attribute_id'));
        $category->manufacturers()->sync($request->input('manufacturer_id'));
        
        $log = $this->activityLogService->init('دسته بندی', 'created')->prepare($category)->finalize()->save();

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "دسته‌بندی $category->name ایجاد شد."
        ]);

        return redirect()->route('admin.categories.index');
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
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        $children                   = $category->children()->get()->toArray();
        $parents                    = Category::where('id', '<>', $category->id)->pluck('name','id')->toArray();

        $filters                    = FilterGroup::get()->pluck('name_label','id')->toArray() ?? [];
        $selectedFilters            = array_pluck($category->filterGroups->toArray(), 'id');
        
        $attributes                 = AttributeGroups::query()->pluck('name','id')->toArray() ?? [];
        $selectedAttributes         = array_pluck($category->attributeGroups->toArray(), 'id');

        $manufacturers              = Manufacturer::pluck('name', 'id')->toArray();
        $selectedManufactureres     = array_pluck($category->manufacturers->toArray(), 'id');
        
        return view('admin.categories.edit', compact('category', 'parents', 'filters', 'selectedFilters', 'attributes', 'selectedAttributes', 'manufacturers', 'selectedManufactureres'));
    }

    /**
     * Update the specified resource in storage.
     * @param  UpdateCategory $request
     * @param integer $id
     * @return Response
     */
    public function update(UpdateCategory $request, $id)
    {
        $category = Category::findOrFail($id);
        $log = $this->activityLogService->init('دسته بندی', 'updated')->prepare($category, 'old');
        $categoryData = $request->only(['name', 'title', 'label', 'slug', 'content', 'meta_description', 'parent_id', 'sort_order', 'discount', 'status', 'twitter_title', 'twitter_description', 'canonical', 'size_type']);
        $categoryData['user_id'] = auth()->user()->id;
        $categoryData['is_nofollow'] = $request->input('is_nofollow', false);
        $categoryData['is_noindex'] = $request->input('is_noindex', false);
        $categoryData['show_in_menu'] = $request->input('show_in_menu', false);
        $categoryData['has_slider'] = $request->input('has_slider', false);

        if($request->hasFile('icon')) {
            $name = pathinfo($request->icon->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->icon->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->icon->getClientOriginalExtension())) {
                $categoryData['icon'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->icon->getClientOriginalExtension();
            }
        }
        
        if ($request->hasFile('image')) {
            $name = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->image->getClientOriginalExtension())) {
                $categoryData['image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('og_image')) {
            $name = pathinfo($request->og_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->og_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->og_image->getClientOriginalExtension())) {
                $categoryData['og_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->og_image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('twitter_image')) {
            $name = pathinfo($request->twitter_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->twitter_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->twitter_image->getClientOriginalExtension())) {
                $categoryData['twitter_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->twitter_image->getClientOriginalExtension();
            }
        }

        if ($request->input('remove_image'))
        {
            $categoryData['image'] = NUll;
        }
        
        $category->update($categoryData);

        $category->filterGroups()->sync($request->input('filter_id'));
        $category->attributeGroups()->sync($request->input('attribute_id'));
        $category->manufacturers()->sync($request->input('manufacturer_id'));

        $log->prepare($category)->finalize()->save();
        
        success();
        
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Integer $id Identifier of the category
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $category = Category::findOrFail($id);
        $log = $this->activityLogService->init('دسته بندی', 'deleted')->prepare($category, 'old')->finalize()->save();
        $category->delete();

        success();

        return redirect()->route('admin.categories.index');
    }
}
