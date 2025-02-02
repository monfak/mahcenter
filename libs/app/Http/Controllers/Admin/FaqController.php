<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FaqController extends Controller
{
    protected $activityLogService;
    
    /**
     * FaqController constructor.
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('permission:faqs-manage');
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            abort_unless($request->ajax(), 404);
            $faq = Faq::latest();
            return Datatables::of($faq)
                ->setTotalRecords($faq->count())
                ->editColumn('created_at', function ($faq) {
                    return view('admin.faqs.partials.datatables.created_at', compact('faq'));
                })
                ->editColumn('is_active', function ($faq) {
                    return view('admin.faqs.partials.datatables.is_active', compact('faq'));
                })
                ->addColumn('actions', function ($faq) {
                    return view('admin.faqs.partials.datatables.actions', compact('faq'));
                })
                ->rawColumns(['is_active', 'actions'])
                ->make(true);
        }
        return view('admin.faqs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\FaqRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        $faqData = $request->only(['heading', 'sort_order', 'content', 'is_active']);
        $faqData['is_active'] = $request->input('is_active', false);
        $faq = Faq::create($faqData);
        $log = $this->activityLogService->init('سوال متداول', 'created')->prepare($faq)->finalize()->save();
        success('سوال با موفقیت به سوالات متداول اضافه شد.');
        return redirect()->route('admin.faqs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\FaqRequest  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        $log = $this->activityLogService->init('سوال متداول', 'updated')->prepare($faq, 'old');
        $faqData = $request->only(['heading', 'sort_order', 'content', 'is_active']);
        $faqData['is_active'] = $request->input('is_active', false);
        $faq->update($faqData);
        $log->prepare($faq)->finalize()->save();
        success('سوال با موفقیت آپدیت شد.');
        return redirect()->route('admin.faqs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::query()->find($id);
        $log = $this->activityLogService->init('سوال متداول', 'deleted')->prepare($faq, 'old')->finalize()->save();
        Faq::destroy($id);
        success('سوال مورد نظر با موفقیت حذف شد.');
        return redirect()->route('admin.faqs.index');
    }
}
