<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * ReviewController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:reviews-manage');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $reviews = Review::latest()->paginate();
        return view()->first(['admin.reviews.index', 'review::index'], compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('review::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['seen_at' => now()]);
        return view()->first(['admin.reviews.show', 'review::show'], compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('review::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param integer $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $answer = new Review([
            'user_id'       => auth()->user()->id,
            'product_id'    => $review->product_id,
            'ip'            => $request->ip(),
            'content'       => $request->input('answer'),
            'parent_id'     => $review->id,
            'status'        => 1,
        ]);

        $answer->save();

        success();

        return redirect()->route('admin.reviews.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $review = Review::findorFail($id);

        if (isset($data['active'])) {
            $stat = $data['active'];
            $stat = ($stat == 1 ? 1 : 0);
            $review->status = $stat;
            $review->save();
        }

        if ( isset($data['delete'] ))
            $review->delete();


        success();
        return redirect()->route('admin.reviews.index');
    }
}
