<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeGroups;
use App\Http\Requests\StoreAttribute;
use App\Http\Requests\UpdateAttribute;
use App\Services\ActivityLogService;

class AttributeController extends Controller
{
    protected $activityLogService;
    
    /**
     * AttributeController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:attributes-manage');
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $attributeGroups = AttributeGroups::orderBy('sort_order','ASC')->get();
        return view()->first(['admin.attributes.index', 'attribute::index'], compact('attributeGroups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view()->first(['admin.attributes.create', 'attribute::create']);
    }

    /**
     * Store a newly created resource in storage.
     * @param  StoreAttribute $request
     * @return Response
     */
    public function store(StoreAttribute $request)
    {
        $attributeGroup = new AttributeGroups([
            'name'       => $request->input('group_name'),
            'sort_order' => $request->input('group_sort_order'),
        ]);

        $attributeGroup->save();

        if ($request->input('name')) {
            foreach ($request->input('name') as $key => $name) {
                if (is_null($name)) {
                    continue;
                }
                $attributes[] = [
                    'group_id'   => $attributeGroup->id,
                    'name'       => $name,
                    'sort_order' => $request->input('sort_order')[$key]
                ];
            }

            Attribute::insert($attributes);
        }
        $log = $this->activityLogService->init('خصوصیات', 'created')->prepare($attributeGroup)->finalize()->save();
        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "ویژگی $attributeGroup->name با موفقیت ایجاد گردید."
        ]);

        return redirect()->route('admin.attributes.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('attribute::show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param integer $id
     * @return Response
     */
    public function edit($id)
    {
        $attributeGroup = AttributeGroups::findOrFail($id);
        return view()->first(['admin.attributes.edit', 'attribute::edit'], compact('attributeGroup'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateAttribute $request
     * @param integer $id
     * @return Response
     */
    public function update(UpdateAttribute $request, $id)
    {
        $attributeGroup = AttributeGroups::findOrFail($id);
        $log = $this->activityLogService->init('خصوصیات', 'updated')->prepare($attributeGroup, 'old');

        $attributeGroup->name       = $request->input('group_name');
        $attributeGroup->sort_order = $request->input('group_sort_order');

        $attributeGroup->save();

        // Updates old
        if($request->input('keep_attributes')) {
            foreach ($request->input('keep_attributes') as $id) {
                $attributeGroup->attributes()->where('id', $id)->update([
                    'sort_order'    => $request->input('sort_order')[$id],
                    'name'          => $request->input('name')[$id],
                ]);
            }
        }

        // Removes removed
        if ($request->input('keep_attributes')) {
            $old = array_diff(array_pluck($attributeGroup->attributes->toArray(), 'id'), $request->input('keep_attributes'));
        } else {
            $old = array_pluck($attributeGroup->attributes->toArray(), 'id');
        }
        $attributeGroup->attributes()->whereIn('id', $old)->delete();

        // Adds new
        $newAttribute = array_diff_key($request->input('name'), $request->input('keep_attributes') ?? []);
        if ($newAttribute) {
            $attributes = [];
            foreach ($newAttribute as $key => $name) {
                if (is_null($request->input('name')[$key])) {
                    continue;
                }
                $attributes[] = [
                    'group_id'      => $attributeGroup->id,
                    'name'          => $request->input('name')[$key],
                    'sort_order'    => $request->input('sort_order')[$key]
                ];
            }

            Attribute::insert($attributes);
        }

        $log->prepare($product)->finalize()->save();
        
        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "ویژگی‌ها با موفقیت آپدیت شدند."
        ]);

        return redirect()->route('admin.attributes.index');
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
        $attributeGroup = AttributeGroups::findOrFail($id);
        
        $log = $this->activityLogService->init('خصوصیات', 'deleted')->prepare($attributeGroup, 'old')->finalize()->save();

        if(isset($data['delete']))
        {
            $attributeGroup->delete();
        }

        success();

        return redirect()->route('admin.attributes.index');
    }
}
