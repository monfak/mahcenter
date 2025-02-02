<?php

namespace App\Http\Controllers\Admin;

use App\Utilities\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Page;
use App\Http\Requests\StorePage;
use App\Http\Requests\UpdatePage;
use App\Services\ActivityLogService;

class PageController extends Controller
{
    protected $activityLogService;
    
    /**
     * PageController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:pages-manage');
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pages = Page::latest()->paginate();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePage $request
     * @return Response
     */
    public function store(StorePage $request)
    {
        $page_data = $request->only(['heading', 'title', 'slug', 'content', 'meta_description', 'status', 'twitter_title', 'twitter_description', 'canonical']);
        $page_data['user_id'] = auth()->user()->id;
        $page_data['is_nofollow'] = $request->input('is_nofollow', false);
        $page_data['is_noindex'] = $request->input('is_noindex', false);

        if ($request->hasFile('image')) {
            $name = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->image->getClientOriginalExtension())) {
                $page_data['image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('og_image')) {
            $name = pathinfo($request->og_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->og_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->og_image->getClientOriginalExtension())) {
                $page_data['og_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->og_image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('twitter_image')) {
            $name = pathinfo($request->twitter_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->twitter_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->twitter_image->getClientOriginalExtension())) {
                $page_data['twitter_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->twitter_image->getClientOriginalExtension();
            }
        }

        $page = Page::create($page_data);
        
        $log = $this->activityLogService->init('صفحه', 'created')->prepare($page)->finalize()->save();

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "صفحه $page->name ایجاد شد."
        ]);

        return redirect()->route('admin.pages.index');
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
     * @param Page $page
     * @return Response
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdatePage $request
     * @return Response
     */
    public function update(UpdatePage $request, $id)
    {
        $page = Page::findOrFail($id);
        $log = $this->activityLogService->init('صفحه', 'updated')->prepare($page, 'old');
        $page_data = $request->only(['heading', 'title', 'slug', 'content', 'meta_description', 'status', 'twitter_title', 'twitter_description', 'canonical']);
        $page_data['is_nofollow'] = $request->input('is_nofollow', false);
        $page_data['is_noindex'] = $request->input('is_noindex', false);

        if ($request->hasFile('image')) {
            $name = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->image->getClientOriginalExtension())) {
                $page_data['image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('og_image')) {
            $name = pathinfo($request->og_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->og_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->og_image->getClientOriginalExtension())) {
                $page_data['og_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->og_image->getClientOriginalExtension();
            }
        }
        if ($request->hasFile('twitter_image')) {
            $name = pathinfo($request->twitter_image->getClientOriginalName(), PATHINFO_FILENAME);
            if ($request->twitter_image->storeAs('public/images/' . date('Y/m'), $name . '.' . $request->twitter_image->getClientOriginalExtension())) {
                $page_data['twitter_image'] = 'storage/images/' . date('Y/m') . '/' . $name . '.' . $request->twitter_image->getClientOriginalExtension();
            }
        }

        $page->update($page_data);
        $log->prepare($page)->finalize()->save();

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "صفحه $page->name آپدیت شد."
        ]);

        return redirect()->route('admin.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Integer $id Identifier of the article
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $page = Page::findOrFail($id);
        
        $log = $this->activityLogService->init('صفحه', 'deleted')->prepare($page, 'old')->finalize()->save();

        if (auth()->user()->can('manage-store')) {
            $article->delete();
        }

        success();

        return redirect()->route('admin.pages.index');
    }
}
