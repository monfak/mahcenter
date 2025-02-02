<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Product;
use App\Models\Category;


class CompareController extends Controller
{
    /**
     * Adds an specific product to the cart
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add(Request $request, $id)
    {
        abort_unless($request->ajax(), 404);
        $id = (int) $id;

        $product = Product::where('status', 1)->where('id', $id)->first();
        if ($product)
        {
            if (!session()->has('compare.' . $id)) {
                session(['compare.'.$id =>  $id]);
            }

            session()->save();

            $message = [
                'status'            => 'success',
                'body'              => "محصول با موفقیت به بخش مقایسه اضافه گردید.",
                'itemsInCompare'    => session('compare') ? count(session('compare')) : 0
            ];
        }
        else
        {
            $message = [
                'status'    => 'danger',
                'body'      => "محصول مورد نظر شما وجود ندارد."
            ];
        }


        return response()->json($message);
    }

    /**
     * Adds an specific product to the cart
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function remove(Request $request, $id)
    {
        $id = (int) $id;

        Product::findOrFail($id);

        if (session()->has('compare.' . $id)) {

            session()->forget('compare.' . $id);
        }

//        session()->save();

        return redirect()->route('compare');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $products = [];
         $attributes = [];
        if(session()->has('compare')) {
            $products = Product::find(session('compare'))->take(4);
            foreach ($products as $product) {
                foreach ($product->attributes as $attribute)
                {
                    $attributes[$attribute->group->id]['group'] = $attribute->group->name;
                    $attributes[$attribute->group->id]['attributes'][$attribute->name][$product->id] = $attribute->pivot->value;
                }
            }
        }
        return view('frontend.compare', compact('products', 'attributes'));
    }


    public function addCompare(Request $request)
    {
        $product_id = [];
        $category_id = [];
        $product_all = null;

        if (session()->has('compare')) {
            $product_id = Product::find(session('compare'))->pluck('id');
            if(!$product_id->isEmpty())
            {
                $category_id = Product::query()
                    ->whereIn('id', session('compare'))
                    ->first()
                    ->categories()
                    ->whereHas('parent', function ($query) {
                        $query->whereDoesntHave('parent');
                    })
                    ->value('id');
                $product_all = Product::where('status', 1)->whereNotIn('id', $product_id)
                    ->whereHas('categories',function ($q) use ($category_id){
                       $q->where('id', $category_id);
                    })->get();
            } else {
                 $product_all = Product::where('status', 1)->latest()->get();
            }
        }
        else {
             $product_all = Product::where('status', 1)->latest()->get();
        }




        return view('frontend.addCompare', compact('product_all'));

    }


    public function ajaxSearch(Request $request)
    {
        $phrase = $request->phrase ?? null;
        $categories = [];
        if($phrase == 'no') {
            $product_id = [];
            $category_id = [];
            if (session()->has('compare') && !session('compare')==[]) {
                $product_id = Product::find(session('compare'))->pluck('id');
                $category_id = Product::query()->whereIn('id',session('compare'))->first()->categories()->pluck('id')->toArray();
                $products  = Product::where('status', 1)->whereNotIn('id', $product_id)
                ->whereHas('categories',function ($q) use ($category_id){
                   $q->whereIn('id', $category_id);
                })->get();
            }
            else{
                 $products = Product::where('status', 1)->latest()->get();
            }
        } else {
            $phrase = convertArabicStringToPersian($phrase);
            $category = $request->category ?? null;
            
            if($category) {
    
                $products = Product::where('status', 1)
                    ->whereHas('categories', function (Builder $query) use ($category) {
                        $query->where('id', $category);
                    })->where('name', 'LIKE', "%$phrase%")->latest()->get();
    
            } else {
    
                $product_id = [];
                $category_id = [];
    
                if (session()->has('compare') && !session('compare')==[]) {
                    $product_id = Product::find(session('compare'))->pluck('id');
                    $category_id = Product::query()->whereIn('id',session('compare'))->first()->categories()->pluck('id')->toArray();
    
                    $products = Product::where('status', 1)->whereNotIn('id', $product_id)
                    ->whereHas('categories',function ($q) use ($category_id){
                       $q->whereIn('id', $category_id);
                    })->where('name', 'LIKE', "%$phrase%")->latest()->get();
    
                } else {
                     $products = Product::where('status', 1)->where('name', 'LIKE', "%$phrase%")->latest()->get();
                }
            }
        }

        $products = view('frontend.partials.compare-product', compact('phrase', 'products', 'categories'))->render();
        return response()->json($products);
    }
}
