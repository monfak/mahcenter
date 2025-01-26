<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Http\Requests\ReviewStore;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('review::index');
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
     * @param ReviewStore $request
     * @return Response
     */
    public function store(ReviewStore $request)
    {
        Product::findOrfail($request);

        $review_data = [
            'user_id'       => auth()->user()->id ?? null,
            'ip'            => $request->ip(),
            'name'          => auth()->user()->name ?? $request->input('name'),
            'email'         => auth()->user()->email ?? $request->input('email'),
            'title'         => $request->input('title'),
            'star'          => $request->input('rating'),
            'content'       => $request->input('content'),
            'parent_id'     => $request->input('answer_to'),
            'product_id'    => $request->input('product_id'),
            'status'        => 0,
        ];

        $review = new Review($review_data);

        $review->save();

        $product = Product::findOrFail($request->input('product_id'));

        success('از نظر شما سپاسگزاریم. نظر شما برای تایید مدیر ارسال شده است.');

        return redirect()->route('products.show', ['slug' => $product->slug]);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('review::show');
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
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
