<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\ImageManager;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use App\Models\Article;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Order;
use App\Events\OrderPaid;
use Illuminate\Support\Facades\DB;
use App\Models\FilterGroup;

class SiteController extends Controller
{
    /**
     * Search for products in a specific categories or in all categories.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $phrase = $request->input('s') ?? null;
        $category = $request->category ?? null;
        $products = Product::query()
                            ->where('status', 1)
                            ->orderBy(DB::raw("CASE WHEN stock > 0 THEN sort_order END"), "DESC")
                            ->orderBy('stock', 'DESC');
        if($phrase) {
            $phrases = explode(' ', $phrase);
            foreach($phrases as $key) {
                $products->where('name', 'LIKE', "%$key%");
            }
        }
        $pro = $products->get();

        $manufacturers = Manufacturer::whereIn('id',$pro->pluck('manufacturer_id'))->get();

        $filterGroups = FilterGroup::whereHas('category', function ( $query) use ($pro) {
            $cat_ids = Category::whereHas('products', function ($query) use ($pro) {
                $query->where('parent_id','<>',null)->whereIn('id',$pro->pluck('id'));
        })->pluck('id');
            $query->whereIn('id', $cat_ids);
        })->where('name','<>','برند')->with('filters')->get();

        $mostExpensiveProduct   = $products->latest('price')->first();
        $highlightAttributes=null;
        foreach ($products as $product) {
            $highlightAttributes[$product->id] = [];
            foreach ($product->attributes as $attribute)
            {
                if ($attribute->pivot->highlight)
                {
                    $highlightAttributes[$product->id][$attribute->name] = $attribute->pivot->value;
                }
            }
        }
        $products= $products->paginate(24);
        return view('frontend.search', compact('phrase', 'filterGroups', 'products','mostExpensiveProduct','manufacturers','highlightAttributes'));
    }

    public function filter(Request $request){
        abort_unless($request->ajax(), 400);

        $limit = $request->input('limit');
        if ($request->limit != 24 && $request->limit != 48 && $request->limit != 96 && $request->limit != 120) {
            $limit = 24;
        }
        switch ($request->order) {
            case 'most_viewed':
                $order = 'view_counts';
                $sort = 'DESC';
                break;
            case 'latest':
                $order = 'created_at';
                $sort = 'DESC';
                break;
            case 'price_asc':
                $order = 'price';
                $sort = 'ASC';
                break;
            case 'price_desc':
                $order = 'price';
                $sort = 'DESC';
                break;
            case 'most_popular':
                $order = 'most_popular';
                $sort = 'DESC';
                break;
            case 'best_seller':
                $order = 'best_seller';
                $sort = 'DESC';
                break;
            default:
                $order = 'created_at';
                $sort = 'DESC';
        }
        $phrase = $request->input('s') ?? null;


        $products = Product::where('name', 'LIKE', "%$phrase%")->where('status', 1)->orderBy(DB::raw("CASE WHEN stock > 0 THEN sort_order END"), "DESC")->orderBy('stock', 'DESC')->get();


         $filterGroups = FilterGroup::whereHas('category', function ($query) use ($products) {
            $cat_ids = Category::whereHas('products', function ($query) use ($products) {
                $query->where('parent_id','<>',null)->whereIn('id', $products->pluck('id'));
            })->pluck('id');

            $query->whereIn('id', $cat_ids);
        })->with('filters')->get();

        $filters = [];
        foreach ($filterGroups as $group) {
            foreach ($group->filters as $filter) {
                if (in_array($filter->id, $request->input('filters') ?? [])) {
                    $filters[$group->id][] = $filter->id;
                }
            }
        }

        $manufacturers = $request->manufacturers ?? [];

        $mostExpensiveProduct   = $request->mostExpensiveProduct;

        $maxProductPrice = (int) $mostExpensiveProduct;

        $minPrice = $request->minPrice ?? null;
        $maxPrice = $request->maxPrice ?? null;
        if($minPrice == 0) {
            $minPrice = null;
        }
        if($maxPrice == $maxProductPrice) {
            $maxPrice = null;
        }
        $products = $this->filteredProducts($filters, $limit, $order, $sort, $minPrice, $maxPrice, $manufacturers, $phrase);

        $products = view('frontend.partials.categories.product', compact('products'))->render();

        return response()->json($products);
    }


    public function filteredProducts(array $filters, $limit = 24, $order = 'created_at', $sort = 'ASC', $minPrice = null, $maxPrice = null, $manufacturers = [], $phrase = null)
    {
        $query = Product::where('name', 'LIKE', "%$phrase%")->where('status',true)->when(!empty($filters), function($query) use ($filters) {
                foreach ($filters as $filter) {
                    $query->whereHas('filters', function($query) use ($filter) {
                        $query->whereIn('filter_id', $filter);
                    });
                }
            })->where('status', 1);
            if (!is_null($minPrice)) {
                $query->where('price', '>=', $minPrice);
            }
            if (!is_null($maxPrice)) {
                $query->where('price', '<=', $maxPrice);
            }

            if ($manufacturers) {
                $query->whereIn('manufacturer_id', $manufacturers);
            }
            if($sort=="ASC" && $order=="price") {

                 return $query->orderBy(DB::raw("stock>0 DESC , CASE WHEN special>0 THEN special else price END"))->paginate($limit);
            } else if($sort=="DESC" && $order=="price") {
                   return $query->orderBy(DB::raw("CASE WHEN stock > 0 AND special>0 THEN special WHEN stock > 0 THEN price END"), $sort)->orderBy('stock', 'DESC')->paginate($limit);

            } else {
              return $query->orderBy(DB::raw("CASE WHEN stock > 0 THEN $order END"), $sort)->orderBy('stock', 'DESC')->paginate($limit);
            }
    }

    public function showQuestion()
    {
        $questions = Banner::getBanner('question');
        return view()->first(['frontend.questions.index'], compact('questions'));
    }

    public function searchAjax(Request $request){
        $phrase = $request->input('s');
        $phrase = convertArabicStringToPersian($phrase);
        $category = $request->input('category');
        $productsQuery = Product::query()
                                ->orderBy(DB::raw("CASE WHEN stock > 0 THEN sort_order END"), "DESC")
                                ->orderBy('stock', 'DESC');
        if($category) {
            $productsQuery->whereHas('categories', function($q) use($category){
                $q->where('id', $category);
            });
        }
        if($phrase) {
            $phrases = explode(' ', $phrase);
            foreach($phrases as $key) {
                $productsQuery->where('name', 'LIKE', "%$key%");
            }
        }
        $productsQuery->orWhere('model', 'like', "%$phrase%");
        $products = $productsQuery->published()->get();
        return view('frontend.layouts.partials.ajax-search',compact('products'));
    }
}
