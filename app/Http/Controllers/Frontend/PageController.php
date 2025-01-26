<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Page;
use App\Models\Banner;

class PageController extends Controller
{
    /**
     * Show the specified resource.
     *
     * @param Page $page
     * @return Response
     */
    public function show(Page $page)
    {
        if (!$page->status) {
            abort(404);
        }
        return view()->first(['frontend.page'], compact('page'));
    }
    public function faqs()
    {
        $questions=Banner::getBanner('question');

        return view()->first(['frontend.questions.index'], compact('questions'));
    }

}
