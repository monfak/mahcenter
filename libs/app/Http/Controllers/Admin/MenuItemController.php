<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuItemRequest;
use App\Models\Menu;
use App\Models\MenuItems;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ActivityLogService;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class MenuItemController extends Controller
{
    protected $activityLogService;
    
    /**
     * CategoryController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:menus-manage');
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function index(Menu $menu)
    {
        return view('admin.menus.items.index', compact('menu'));
    }

    /**
     * Proceeds ajax request for datatable.
     *
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function ajax(Request $request, Menu $menu)
    {
        abort_unless($request->ajax(), 404);
        $items = MenuItems::with('parent')->where('menu_id', $menu->id);
        return Datatables::of($items)
            ->setTotalRecords($items->count())
            ->addColumn('parent', function ($item) {
                return $item->parent?->name ?? '';
            })
            ->editColumn('is_active', function ($item) {
                return view('admin.menus.items.partials.datatables.is_active', compact('item'));
            })
            ->addColumn('actions', function ($item) {
                return view('admin.menus.items.partials.datatables.actions', compact('item'));
            })
            ->rawColumns(['is_active', 'actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function create(Menu $menu)
    {
        $parents    = MenuItems::whereMenuId($menu->id)->pluck('heading', 'id')->toArray();
        return view('admin.menus.items.create', compact('menu', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Menu  $menu
     * @param  \App\Http\Requests\MenuItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Menu $menu, MenuItemRequest $request)
    {
        $itemData  = $request->only(['heading', 'label', 'url', 'parent_id',  'sort_order']);
        $itemData['is_active'] = $request->input('is_active', false);
        if($request->hasFile('image'))
        {
            $name = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            if($request->image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->image->extension()))
            {
                $image = Image::create([
                    'user_id'   => auth()->id(),
                    'name'      => 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->image->extension(),
                ]);
                $itemData['image'] = $image->name;
            }
        }
        $item = $menu->items()->create($itemData);
        $log = $this->activityLogService->init('ایتم منو', 'created')->prepare($item)->finalize()->save();
        success("آیتم $item->name ایجاد شد.");
        return redirect()->route('admin.menus.items.index', $menu->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MenuItems  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuItems $item)
    {
        $item->load('menu');
        $menu       = $item->menu;
        $children   = $item->children()->get()->toArray() ?? [];
        $parents    = MenuItems::whereMenuId($item->menu->id)->where('id', '<>', $item->id)->whereNotIn('id', $children)->pluck('heading','id')->toArray();
        return view('admin.menus.items.edit', compact('menu', 'item', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MenuItemRequest  $request
     * @param  \App\Models\MenuItems  $item
     * @return \Illuminate\Http\Response
     */
    public function update(MenuItemRequest $request, MenuItems $item)
    {
        $log = $this->activityLogService->init('آیتم منو', 'updated')->prepare($item, 'old');
        $itemData  = $request->only(['heading', 'label', 'url', 'parent_id',  'sort_order']);
        $itemData['is_active'] = $request->input('is_active', false);
        if($request->hasFile('image'))
        {
             $name = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            if($request->image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->image->extension()))
            {
                $image = Image::create([
                    'user_id'   => auth()->id(),
                    'name'      => 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->image->extension(),
                ]);
                $itemData['image'] = $image->name;
            }
        }
        if ($request->input('remove_image'))
        {
            $itemData['image'] = NUll;
        }
        $item->update($itemData);
        $log->prepare($item)->finalize()->save();
        success('آیتم با موفقیت آپدیت شد.');
        return redirect()->route('admin.menus.items.index', $item->menu_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MenuItems  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MenuItems $item)
    {
        $log = $this->activityLogService->init('آیتم منو', 'deleted')->prepare($item, 'old')->finalize()->save();
        $menu_id = $item->menu_id;
        $item->delete();
        success('منو با موفقیت حذف شد.');
        return redirect()->route('admin.menus.items.index', $menu_id);
    }
}
