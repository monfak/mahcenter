<?php

namespace App\Http\Controllers\Admin;

use App\Utilities\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\StoreBanner;
use App\Models\Banner;
use App\Models\BannerItem;
use App\Http\Requests\UpdateBanner;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    /**
     * BannerController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:banners-manage');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $banners = Banner::latest()->paginate();
        return view()->first(['admin.banners.index', 'banner::index'], compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view()->first(['admin.banners.create', 'banner::create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * This action saves a banner and its items into the database.
     *
     * @param  StoreBanner $request
     * @return Response
     */
    public function store(StoreBanner $request)
    {
        $banner = new Banner([
            'name'      => $request->input('name'),
            'position'  => $request->input('position'),
            'width'     => $request->input('width'),
            'height'    => $request->input('height'),
            'status'    => $request->input('status') ? 1 : 0,
        ]);
        $banner->save();

        // Puts items (inputs) of each row into an index of the banners array.
        $banners = array_map(function ($input, $banner_id) {
            $banners = [];
            foreach($input as $inputKey => $inputValues)
            {
                foreach ($inputValues as $key => $value)
                {
                    $banners[$key][$inputKey]       = $value;
                    $banners[$key]['banner_id']     = $banner_id;
                    $banners[$key]['created_at']    = date('Y-m-d H:i:s');
                    $banners[$key]['updated_at']    = date('Y-m-d H:i:s');
                    $banners[$key]['image']         = NULL;
                }
            }
            return $banners;
        }, [$request->only('title', 'url', 'content', 'sort_order')], [$banner->id])[0];

        if($request->hasfile('image'))
        {
            $date = date('Y/m');
            foreach($request->file('image') as $key => $image)
            {
                $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                if($image->storeAs('public/images/' . $date, $name . '.' . $image->getClientOriginalExtension()))
                {
                    $banners[$key]['image'] = 'storage/images/' . $date . '/' . $name . '.' . $image->getClientOriginalExtension();
                }
            }
        }

        BannerItem::insert($banners);

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "آگهی شما با نام $banner->name ایجاد شد."
        ]);
        return redirect()->route('admin.banners.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('banner::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view()->first(['admin.banners.edit', 'banner::edit'], compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBanner $request
     * @param integer $id
     * @return Response
     */
    public function update(UpdateBanner $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $banner->name = $request->input('name');
        $banner->position = $request->input('position');
        $banner->width = $request->input('width');
        $banner->height = $request->input('height');
        $banner->status = $request->input('status') ? 1 : 0;

        $banner->save();

        // To make current Year and month directories.
        $date = date('Y/m');

        // Removes old banner items
        if ($request->input('keeper')) {
            $remove = array_diff_key(array_pluck($banner->items->toArray(), 'id', 'id'), $request->input('keeper'));
            $newBanners = array_diff_key($request->input('title'), $request->input('keeper'));
        } else {
            $remove = array_pluck($banner->items->toArray(), 'id', 'id');
            $newBanners = $request->input('title');
        }
        $banner->items()->whereIn('id', $remove)->delete();

        // Updates old banner items
        if ($request->input('keeper')){
            foreach ($request->input('keeper') as $key => $input) {
                $item_data = [
                    'title' => $request->input('title.' . $key),
                    'url' => $request->input('url.' . $key),
                    'content' => $request->input('content.' . $key),
                    'sort_order' => $request->input('sort_order.' . $key),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                if($request->hasfile('image.' . $key)) {
                    $image  = $request->file('image.' . $key);
                    $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

                    if($image->storeAs('public/images/banners/' . $date, $name . '.' . $image->getClientOriginalExtension()))
                    {
                        if($image->storeAs('public/images/' . $date, $name . '.' . $image->getClientOriginalExtension()))
                        {
                            $item_data['image'] = 'storage/images/' . $date . '/' . $name . '.' . $image->getClientOriginalExtension();
                        }
                    }
                }

                $banner->items()->where('id', $key)->update($item_data);
            }
        }

        // Add new banner items.
        $banners = [];
        if($newBanners) {
            foreach ($newBanners as $key => $value) {
                $banners[$key] = [
                    'banner_id'     => $banner->id,
                    'title'         => $request->input('title.' . $key),
                    'content'       => $request->input('content.' . $key),
                    'url'           => $request->input('url.' . $key),
                    'sort_order'    => $request->input('sort_order.' . $key),
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                ];
                $banners[$key]['image'] = NULL;
            }
        }

        if($request->hasfile('image'))
        {
            foreach($request->file('image') as $key => $image)
            {
                if (in_array($key, $request->input('keeper') ?? [])) {
                    continue;
                }

                $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                if($image->storeAs('public/images/' . $date, $name . '.' . $image->getClientOriginalExtension()))
                {
                    $banners[$key]['image'] = 'storage/images/' . $date . '/' . $name . '.' . $image->getClientOriginalExtension();
                }
            }
        }

        BannerItem::insert($banners);

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "آگهی شما با نام $banner->name آپدیت شد."
        ]);

        return redirect()->route('admin.banners.index');
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
        $banner = Banner::findOrFail($id);
        $banner->delete();
        success();
        return redirect()->route('admin.banners.index');
    }
}
