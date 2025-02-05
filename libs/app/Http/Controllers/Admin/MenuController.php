<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use App\Models\Image;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ActivityLogService;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    protected $activityLogService;
    
    /**
     * MenuController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:menus-manage');
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::query()->latest()->paginate();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $menuData = $request->only(['name', 'position']);
        $menuData['is_active'] = $request->input('is_active', false);
        $menu = Menu::create($menuData);
        $log = $this->activityLogService->init('منو', 'created')->prepare($menu)->finalize()->save();
        success('منو مورد نظر شما با موفقیت ایجاد گردید.');
        return redirect()->route('admin.menus.index');
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
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PageRequest  $request
     * @param  App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $log = $this->activityLogService->init('منو', 'updated')->prepare($menu, 'old');
        $menuData = $request->only(['name', 'position']);
        $menuData['is_active'] = $request->input('is_active', false);
        $menu->update($menuData);
        $log->prepare($menu)->finalize()->save();
        success('منو مورد نظر شما با موفقیت آپدیت گردید.');
        return redirect()->route('admin.menus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Menu $menu)
    {
        $log = $this->activityLogService->init('منو', 'deleted')->prepare($menu, 'old')->finalize()->save();
        $menu->delete();
        success('منو مورد نظر شما با موفقیت حذف گردید.');
        return redirect()->route('admin.menus.index');
    }
}
