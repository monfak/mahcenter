<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        //abort_if($category->parent_id == null, 404);
        abort_unless($category->status, 404);
        $category->load('filterGroups');
        $highlightAttributes = [];
        $products               = $category->getProductsInStockWithSortOrder();
        $mostExpensiveProduct   = $category->getMostExpensiveProduct();
        $categories = Cache::remember('main-categories', now()->addMinutes(5), function () {
            return Category::with('activeChildren')->whereNull('parent_id')->where('status', 1)->get();
        });
        $manufacturers          = $category->manufacturers;
        foreach ($products as $product) {
            $highlightAttributes[$product->id] = [];
            $image = $product->images()->first() ;
            $product->second_image = @$image->image ;
            foreach ($product->attributes as $attribute)
            {
                if ($attribute->pivot->highlight)
                {
                    $highlightAttributes[$product->id][$attribute->name] = $attribute->pivot->value;
                }
            }
        }
        $isCategoryPage = true;
        return view('frontend.category', compact('isCategoryPage', 'category', 'products', 'mostExpensiveProduct', 'categories', 'highlightAttributes', 'manufacturers'));
    }

    public function filter(Request $request, Category $category)
    {
        abort_unless($request->ajax(), 400);

        $limit = $request->input('limit');
        if ($request->limit != 24 && $request->limit != 32 && $request->limit != 48 && $request->limit != 96 && $request->limit != 120) {
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
                $order = 'stock';
                $sort = 'DESC';
        }

        $filterGroups = $category->filtersWithOutBrandGroup;

        $filters = [];
        foreach ($filterGroups as $group) {
            foreach ($group->filters as $filter) {
                if (in_array($filter->id, $request->input('filters') ?? [])) {
                    $filters[$group->id][] = $filter->id;
                }
            }
        }

        $stock = $request->stockStatus ?? 0;
        $manufacturers = $request->manufacturers ?? [];

        $mostExpensiveProduct   = $category->getMostExpensiveProduct();
        $maxProductPrice = $mostExpensiveProduct->price;

        $minPrice = $request->minPrice ?? null;
        $maxPrice = $request->maxPrice ?? null;
        if($minPrice == 0) {
            $minPrice = null;
        }
        if($maxPrice == $maxProductPrice) {
            $maxPrice = null;
        }

        $products = $category->filteredProducts($filters, $limit, $order, $sort, $minPrice, $maxPrice, $manufacturers,$stock);

        $highlightAttributes = [];
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

        $products = view('frontend.partials.categories.product', compact('products', 'highlightAttributes'))->render();

        return response()->json($products);
    }

    public function description(Category $category) {
        return $this->show($category);
        abort_unless($category->parent_id == null, 404);
        abort_unless($category->status, 404);
        $category->load(['children' => function($query) {
            $query->published()->menu();
        }]);
        $subCategoryIds = $category->getAllSubCategoryIds();
        $isCategoryPage = true;
        $topProducts = Sale::whereIn('category_id', $subCategoryIds)
                            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                            ->groupBy('product_id')
                            ->orderByDesc('total_quantity')
                            ->limit(8)
                            ->get();
        $productIds = $topProducts->pluck('product_id');
        $products = Product::whereIn('id', $productIds)->get();
        return view('frontend.category.index', compact('isCategoryPage', 'category','products'));
    }

}
