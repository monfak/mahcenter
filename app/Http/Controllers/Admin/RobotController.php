<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RobotsRequest;
use Illuminate\Support\Facades\Storage;

class RobotController extends Controller
{
    /**
     * SettingController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:robots-manage');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $filePath = 'robots.txt';
        $content = Storage::disk('public_html')->exists($filePath)
            ? Storage::disk('public_html')->get($filePath)
            : '';
        return view('admin.robots.index', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     * @param  RobotsRequest $request
     * @return Response
     */
    public function store(RobotsRequest $request)
    {
        $filePath = 'robots.txt';
        Storage::disk('public_html')->put($filePath, $request->input('content'));
        success('فایل robots.txt آپدیت شدند.');
        return redirect()->route('admin.robots.index');
    }
}
