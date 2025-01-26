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
use App\Models\Warranty;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $slider = Cache::remember('slider', now()->addMinutes(5), function () {
            return Slide::query()->select(['url', 'image', 'heading'])->active()->get();
        });
        $warranties = Cache::remember('warranties', now()->addMinutes(30), function () {
            return Warranty::query()->active()->inhome()->get();
        });
        $featuredCategories = Cache::remember('featured-categories', now()->addMinutes(5), function () {
            return Banner::query()->with('items')->inPosition('categories')->first();
        });
        $categoriesHasSlider = Cache::remember('categoriesWithProducts', now()->addMinutes(5), function () {
            $categories = Category::query()
                ->where('status', true)
                ->where('has_slider', 1)
                ->orderBy('sort_order', 'desc')
                ->whereNotNull('image')
                ->take(4)
                ->get();

            return $categories->map(function ($category) {
                $products = Product::query()
                ->whereHas('categories', function ($query) use ($category) {
                    $query->where('categories.id', $category->id);
                })
                ->published()
                ->where('price', '>', 0)
                ->where('stock', '>', 0)
                ->inRandomOrder()
                ->take(4)
                ->get();

                return [
                    'category' => $category,
                    'products' => $products
                ];
            });
        });
        $manufacturers = Cache::remember('manufacturers', now()->addMinutes(5), function () {
            return Manufacturer::query()->whereNotNull('logo')->where('total_products', '>', 0)->InRandomOrder()->take(10)->get();
        });
        $mostSalesProducts = Cache::remember('mostSalesProducts', now()->addMinutes(5), function () {
            return Product::query()
                        ->published()
                        ->where('price', '>', 0)
                        ->where('stock', '>', 0)
                        ->latest('total_monthly_sales_count')
                        ->take(15)
                        ->get();
        });
        $cookieName = 'visitedCategoriesWithProducts';
        $visitedCategories = $request->cookie($cookieName) ? json_decode($request->cookie($cookieName), true) : [];
        $recommendedCategories = [];

        // Ensure the visited categories structure is correct
        $visitedCategories = array_filter($visitedCategories, function($category) {
            return isset($category['products']) && is_array($category['products']);
        });

        // Limit to the top 4 categories based on visit order
        $topCategories = array_slice($visitedCategories, 0, 4, true);

        foreach ($topCategories as $categoryId => $data) {
            $productIds = $data['products'];

            // Fetch the visited products first
            $products = Product::query()
                ->whereIn('id', $productIds)
                ->published()
                ->where('price', '>', 0)
                ->where('stock', '>', 0)
                ->orderByRaw("FIELD(id, " . implode(',', $productIds) . ")")
                ->get();

            // Calculate how many additional products are needed to reach 4
            $additionalProductsCount = 4 - $products->count();

            if ($additionalProductsCount > 0) {
                // Fetch additional products from the same category, excluding already visited products
                $additionalProducts = Product::query()
                    ->whereHas('categories', function ($query) use ($categoryId) {
                        $query->where('categories.id', $categoryId);
                    })
                    ->whereNotIn('id', $productIds)
                    ->published()
                    ->where('price', '>', 0)
                    ->where('stock', '>', 0)
                    ->inRandomOrder()
                    ->take($additionalProductsCount)
                    ->get();

                // Merge the additional products with the already visited products
                $products = $products->merge($additionalProducts);
            }

            // Ensure we have exactly 4 products for this category
            $products = $products->take(4);

            // Add the category and its products to the recommended categories array
            $recommendedCategories[] = [
                'category' => Category::query()->find($categoryId),
                'products' => $products
            ];
        }
        $articles = Cache::remember('latestArticles', now()->addMinutes(5), function () {
            return Article::query()->select(['image', 'slug', 'title', 'id'])->published()->latest('created_at')->take(6)->get();
        });
        $specialOffers = Cache::remember('special-offers', now()->addMinutes(5), function () {
            return Product::query()
            ->select(['name', 'slug', 'image', 'price', 'discount', 'special'])
            ->where('status', true)
            ->whereNotNull('special')
            ->where('stock', '>', 0)
            ->notFestival()
            ->inRandomOrder()
            ->get();
        });
        $specialSales = Cache::remember('special-sales', now()->addMinutes(5), function () {
            return Product::query()
            ->select(['name', 'slug', 'image', 'price', 'discount', 'special'])
            ->where('status', true)
            ->festival()
            ->where('stock', '>', 0)
            ->inRandomOrder()
            ->get();
        });

        $belowProducts = Cache::remember('below-products', now()->addMinutes(5), function () {
            return Banner::query()->with('items')->inPosition('below-products')->first();
        });
        $belowSupermarket = Cache::remember('belowSupermarket', now()->addMinutes(5), function () {
            return Banner::query()->with('items')->inPosition('below-supermarket')->first();
        });
        $latestProducts = Cache::remember('latestProducts', now()->addMinutes(5), function () {
            return Product::query()->select(['slug', 'image', 'name'])->latest()->published()->take(10)->get();
        });
        return view('frontend.index', compact('slider', 'warranties', 'featuredCategories', 'articles', 'recommendedCategories', 'categoriesHasSlider', 'mostSalesProducts', 'manufacturers', 'specialOffers', 'specialSales', 'belowSupermarket', 'belowProducts', 'latestProducts'));
    }

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
                        ->where('name', 'LIKE', "%$phrase%")
                        ->where('status', 1)
                        ->orderBy(DB::raw("CASE WHEN stock > 0 THEN price END"), "DESC")
                        ->orderBy('stock', 'DESC');

        $pro = $products->get();

        $manufacturers = Manufacturer::whereIn('id',$pro->pluck('manufacturer_id'))->get();

        $filterGroups = FilterGroup::whereHas('category', function ( $query) use ($pro) {
            $cat_ids = Category::whereHas('products', function ($query) use ($pro) {
                $query->where('parent_id','<>',null)->whereIn('id',$pro->pluck('id'));
        })->pluck('id');
            $query->whereIn('id', $cat_ids);
        })->where('name','<>','برند')->with('filters')->get();

        $mostExpensiveProduct   = $products->latest('price')->first();
        $highlightAttributes = null;

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

        // foreach ($products as $product) {
        //     $highlightAttributes[$product->id] = [];
        //     foreach ($product->attributes as $attribute)
        //     {
        //         if ($attribute->pivot->highlight)
        //         {
        //             $highlightAttributes[$product->id][$attribute->name] = $attribute->pivot->value;
        //         }
        //     }
        // }

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
            if($sort=="ASC" && $order=="price"){

                 return $query->orderBy(DB::raw("stock>0 DESC , CASE WHEN special>0 THEN special else price END"))->paginate($limit);
            }else if($sort=="DESC" && $order=="price"){
                   return $query->orderBy(DB::raw("CASE WHEN stock > 0 AND special>0 THEN special WHEN stock > 0 THEN price END"), $sort)->orderBy('stock', 'DESC')->paginate($limit);

            }else{
              return $query->orderBy(DB::raw("CASE WHEN stock > 0 THEN $order END"), $sort)->orderBy('stock', 'DESC')->paginate($limit);
            }
    }

    public function showQuestion()
    {
        $questions = Banner::getBanner('question');

        return view()->first(['frontend.questions.index'], compact('questions'));
    }

    public function amazing()
    {
        $specialOffers = Product::published()->where('price', '>', 0)->where('stock', '>', 0)->whereNotNull('special')->latest()->paginate(24);
        return view('frontend.amazing_products', compact('specialOffers'));
    }
    
    public function specialSale()
    {
        //abort_unless(get_setting('is_festival_active'), 404);
        $festivalBanners = Cache::remember('festival-banners', now()->addMinutes(5), function () {
            return Banner::with('items')->inPosition('festival')->first();
        });
        $specialOffers = Product::published()->where('price', '>', 0)->where('stock', '>', 0)->festival()->latest()->paginate(24);
        return view('frontend.special_sale', compact('specialOffers', 'festivalBanners'));
    }

    public function searchAjax(Request $request){
        $phrase = $request->input('s');
        $phrase=convertArabicStringToPersian($phrase);
        $category=$request->input('category');
        if($category) {
            $products = Product::where('status', 1)->whereHas('categories', function($q) use($category, $phrase){
                $q->where('id', $category);
            })
            ->where('name', 'like', "%$phrase%")
            ->orWhere('model', 'like', "%$phrase%")
            ->where('status', 1)
            ->latest()
            ->get();
        } else {
            $products = Product::where('name', 'LIKE', "%$phrase%")
                        //->orWhere('model', 'LIKE', "%$phrase%")->latest()
                        ->where('status', 1)
                        ->get();
        }

       return view('frontend.layouts.partials.ajax-search',compact('products'));
    }

}
