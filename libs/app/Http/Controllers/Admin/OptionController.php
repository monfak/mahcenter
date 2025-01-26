<?php

namespace App\Http\Controllers\Admin;

use App\ImageManager;
use Illuminate\Support\Str;
use App\Models\Option;
use App\Models\OptionValue;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OptionController extends Controller
{
    /**
     * OptionController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:options-manage');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::latest()->paginate();

        return view('admin.options.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.options.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreOptionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOptionRequest $request)
    {
        $option = new Option([
            'name'          => $request->input('option_name'),
            'sort_order'    => $request->input('option_sort_order'),
        ]);

        $option->save();

        if ($request->input('name')) {
            foreach ($request->input('name') as $key => $name) {
                if (is_null($name)) {
                    continue;
                }
                $optionValues[$key] = [
                    'option_id'     => $option->id,
                    'name'          => $name,
                    'image'         => null,
                    'sort_order'    => $request->input('sort_order')[$key],
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];
                if($request->hasfile('image.' . $key))
                {
                    $image = $request->file('image.' . $key);
                    $date = date('Y/m');
                    $name = Str::random(64);
                    if($image->storeAs('public/images/options/' . $date, $name . '.' . $image->extension()))
                    {
                        $optionValues[$key]['image'] = 'storage/images/options/' . $date . '/' . $name . '.' . $image->extension();
                        ImageManager::resize($optionValues[$key]['image'], ['width' => 40, 'height' => 40]);
                    }
                }
            }

            OptionValue::insert($optionValues);
        }

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "گزینه $option->name با موفقیت ایجاد گردید."
        ]);

        return redirect()->route('admin.options.index');
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
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        return view('admin.options.edit', compact('option'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOptionRequest $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOptionRequest $request, Option $option)
    {
        $option->name           = $request->input('option_name');
        $option->sort_order     = $request->input('option_sort_order');
        $option->save();

        // Updates old
        if($request->input('keep_options')) {
            foreach ($request->input('keep_options') as $id) {
                $optionValues = [
                    'sort_order'    => $request->input('sort_order')[$id],
                    'name'          => $request->input('name')[$id],
                ];
                if($request->hasfile('image.' . $id))
                {
                    $image = $request->file('image.' . $id);
                    $date = date('Y/m');
                    $name = Str::random(64);
                    if($image->storeAs('public/images/options/' . $date, $name . '.' . $image->extension()))
                    {
                        $optionValues['image'] = 'storage/images/options/' . $date . '/' . $name . '.' . $image->extension();
                        ImageManager::resize($optionValues['image'], ['width' => 40, 'height' => 40]);
                    }
                }
                $option->values()->where('id', $id)->update($optionValues);
            }
        }

        // Removes removed
        if ($request->input('keep_options')) {
            $old = array_diff(array_pluck($option->values->toArray(), 'id'), $request->input('keep_options') ?? []);
        } else {
            $old = array_pluck($option->values->toArray(), 'id');
        }
        $option->values()->whereIn('id', $old)->delete();

        // Adds new
        $newOption = array_diff_key($request->input('name'), $request->input('keep_options') ?? []);
        if ($newOption) {
            $options = [];
            foreach ($newOption as $key => $name) {
                if (is_null($name)) {
                    continue;
                }
                $values[$key] = [
                    'option_id'     => $option->id,
                    'name'          => $name,
                    'sort_order'    => $request->input('sort_order')[$key]
                ];
                if($request->hasfile('image.' . $key))
                {
                    $image = $request->file('image.' . $key);
                    $date = date('Y/m');
                    $name = Str::random(64);
                    if($image->storeAs('public/images/options/' . $date, $name . '.' . $image->extension()))
                    {
                        $values[$key]['image'] = 'storage/images/options/' . $date . '/' . $name . '.' . $image->extension();
                        ImageManager::resize($values[$key]['image'], ['width' => 40, 'height' => 40]);
                    }
                }
            }

            OptionValue::insert($values);
        }

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "گزینه $option->name با موفقیت آپدیت شدند."
        ]);

        return redirect()->route('admin.options.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $option = Option::findOrFail($id);

        if ( isset($data['delete'] ))
        {
            $option->delete();
        }

        success();

        return redirect()->route('admin.options.index');
    }
}
