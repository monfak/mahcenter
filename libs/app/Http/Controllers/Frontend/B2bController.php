<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class B2bController extends Controller
{
    public function index()
    {
        $steps = Banner::with('items')->inPosition('b2b_steps')->first();
        $beforeFaqs = Faq::query()->where('is_before_b2b')->get();
        $afterFaqs = Faq::query()->where('is_after_b2b')->get();
        return view('frontend.b2b.index', compact('steps', 'beforeFaqs', 'afterFaqs'));
    }
}
