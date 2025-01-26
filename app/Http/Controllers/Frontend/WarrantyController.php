<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use App\Models\Warranty;

class WarrantyController extends Controller
{
    public function index(Request $request)
    {
        $warranties = Warranty::query()->active()->latest()->paginate();
        return view('frontend.warranties.index', compact('warranties'));
    }
    
    public function show(Warranty $warranty)
    {
        abort_unless($warranty->is_active, 404);
        return view('frontend.warranties.show', compact('warranty'));
    }
}
