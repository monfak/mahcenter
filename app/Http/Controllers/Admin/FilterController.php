<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Filter;
use App\Models\FilterGroup;
use App\Http\Requests\StoreFilter;
use App\Http\Requests\UpdateFilter;

class FilterController extends Controller
{
    /**
     * FilterController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:filters-manage');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $filterGroups = FilterGroup::latest('sort_order')->get();
        return view()->first(['admin.filters.index', 'filter::index'], compact('filterGroups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view()->first(['admin.filters.create', 'filter::create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFilter $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFilter $request)
    {
        $filterGroup = new FilterGroup([
            'name'       => $request->input('group_name'),
            'label'      => $request->input('group_label'),
            'sort_order' => $request->input('group_sort_order'),
        ]);

        $filterGroup->save();

        if ($request->input('name')) {
            foreach ($request->input('name') as $key => $name) {
                if (is_null($name)) {
                    continue;
                }
                $filters[] = [
                    'filter_group_id'   => $filterGroup->id,
                    'name'              => $name,
                    'sort_order'        => $request->input('sort_order')[$key]
                ];
            }

            Filter::insert($filters);
        }

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "فیلتر $filterGroup->name با موفقیت ایجاد گردید."
        ]);

        return redirect()->route('admin.filters.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('filter::show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $filterGroup = FilterGroup::findOrFail($id);

        return view()->first(['admin.filters.edit', 'filter::edit'], compact('filterGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFilter $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFilter $request, $id)
    {
        $filterGroup = FilterGroup::findOrFail($id);

        $filterGroup->name       = $request->input('group_name');
        $filterGroup->label      = $request->input('group_label');
        $filterGroup->sort_order = $request->input('group_sort_order');

        $filterGroup->save();

        // Updates old
        if($request->input('keep_filters')) {
            foreach ($request->input('keep_filters') as $id) {
                $filterGroup->filters()->where('id', $id)->update([
                    'sort_order'    => $request->input('sort_order')[$id],
                    'name'          => $request->input('name')[$id],
                ]);
            }
        }

        // Removes removed
        if ($request->input('keep_filters')) {
            $old = array_diff(array_pluck($filterGroup->filters->toArray(), 'id'), $request->input('keep_filters'));
        } else {
            $old = array_pluck($filterGroup->filters->toArray(), 'id');
        }
        $filterGroup->filters()->whereIn('id', $old)->delete();

        // Adds new
        $newFilter = array_diff_key($request->input('name'), $request->input('keep_filters') ?? []);
        if ($newFilter) {
            $filters = [];
            foreach ($newFilter as $key => $name) {
                if (is_null($request->input('name')[$key])) {
                    continue;
                }
                $filters[] = [
                    'filter_group_id'   => $filterGroup->id,
                    'name'              => $request->input('name')[$key],
                    'sort_order'        => $request->input('sort_order')[$key]
                ];
            }

            Filter::insert($filters);
        }

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "فیلترها با موفقیت آپدیت شدند."
        ]);

        return redirect()->route('admin.filters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $filterGroup = FilterGroup::findOrFail($id);

        if ( isset($data['delete'] ))
        {
            $filterGroup->delete();
        }

        success();

        return redirect()->route('admin.filters.index');
    }
}
