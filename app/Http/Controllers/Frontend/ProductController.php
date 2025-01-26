<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Cart;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index()
    {
        $products = Product::where('status', true)->latest('stock')->paginate(16);
        return view('frontend.products', compact('products'));
    }

    /**
     * Show the specified resource.
     *
     * @param Request $request
     * @param Product $product
     * @return Response
     */
    public function show(Request $request, Product $product)
    {
        $product->load('attributes', 'attributes.group', 'options', 'options.option', 'options.optionValues', 'questions.answers', 'categories', 'warranties');
        $product->loadCount('warranties');
        abort_unless($product->status, 404);
        
        $attributes = [];
        $highlightAttributes = [];

        foreach ($product->attributes as $attribute)
        {
            $attributes[$attribute->group->id]['group'] = $attribute->group->name;
            $attributes[$attribute->group->id]['group_sort'] = $attribute->group->sort_order;
            $attributes[$attribute->group->id]['attributes'][$attribute->name] = $attribute->pivot->value;
            $attributes[$attribute->group->id]['attrs_desc'][$attribute->name] = $attribute->sort_order;
            if ($attribute->pivot->highlight) {
                $highlightAttributes[$attribute->name] = $attribute->pivot->value;
            }
        }
        $attributes = collect($attributes);
        $attributes = $attributes->sortBy('group_sort');

        $product->excerpt   = substr($product->description, 0, 500);

        $relatedProducts = Cache::remember('related-products' . $product->id, now()->addMinutes(5), function () use($product) {
            return Product::whereHas('categories', function($query) use($product)
            {
                $query->whereIn('id', $product->categories()->where('parent_id','<>',null)->pluck('id'));
            })->whereNotNull('stock')->where('stock', '>', 0)->where('price', '>', 0)->where('id', '!=', $product->id)->inRandomOrder()->distinct()->active()->take(5)->select('slug', 'price', 'special', 'discount', 'name', 'image')->get();
        });

        $suggestedProducts = Cache::remember('suggested-products' . $product->id, now()->addMinutes(5), function () use($product) {
            return Product::whereHas('categories', function($query) use($product) {
                $query->whereIn('id', $product->categories->pluck('id'));
            })->whereNotNull('stock')->where('stock','>',0)->where('price', '>', 0)->where('suggest', 1)->where('id', '!=', $product->id)->inRandomOrder()->distinct()->active()->take(15)->select('slug', 'price', 'special', 'discount', 'name', 'image')->get();
        });

        $productCategories  = $product->categories;

        $deliveryFeatures = Cache::remember('deliveryFeatures', now()->addMinutes(30), function () {
            return Banner::getBanner('delivery-features');;
        });
        $cookieName = 'visitedCategoriesWithProducts';
        $visitedCategories = $request->cookie($cookieName) ? json_decode($request->cookie($cookieName), true) : [];

        $categoryId = $product->categories->whereNull('parent_id')->first()?->id;
        $productId = $product->id;

        if (isset($visitedCategories[$categoryId])) {
            // Check if the product exists in the category
            $productIndex = array_search($productId, $visitedCategories[$categoryId]['products']);
            if ($productIndex !== false) {
                // Bring the product to the top if it exists
                unset($visitedCategories[$categoryId]['products'][$productIndex]);
            }
            // Add the product to the top of the list
            array_unshift($visitedCategories[$categoryId]['products'], $productId);
            // Ensure only the latest 4 products per category are stored
            if (count($visitedCategories[$categoryId]['products']) > 4) {
                $visitedCategories[$categoryId]['products'] = array_slice($visitedCategories[$categoryId]['products'], 0, 4);
            }
            // Preserve the current category's products list
            $categoryProducts = $visitedCategories[$categoryId]['products'];
            // Unset the category to update its order
            unset($visitedCategories[$categoryId]);
            // Reassign the category with updated products list
            $visitedCategories = [$categoryId => ['products' => $categoryProducts]] + $visitedCategories;
        } else {
            // Add new category with the product and 3 random products
            $visitedCategories[$categoryId] = [
                'products' => [$productId]
            ];

            $additionalProducts = Product::whereHas('categories', function ($query) use ($categoryId) {
                    $query->where('categories.id', $categoryId);
                })
                ->where('id', '!=', $productId)
                ->published()
                ->where('price', '>', 0)
                ->where('stock', '>', 0)
                ->inRandomOrder()
                ->take(3)
                ->pluck('id')
                ->toArray();

            $visitedCategories[$categoryId]['products'] = array_merge($visitedCategories[$categoryId]['products'], $additionalProducts);

            // Add the new category to the start of the list
            $visitedCategories = [$categoryId => $visitedCategories[$categoryId]] + $visitedCategories;
            
            if (count($visitedCategories[$categoryId]['products']) < 4) {
                $missingCount = 4 - count($visitedCategories[$categoryId]['products']);
                $moreProducts = Product::whereHas('categories', function ($query) use ($categoryId) {
                        $query->where('categories.id', $categoryId);
                    })
                    ->whereNotIn('id', $visitedCategories[$categoryId]['products']) // جلوگیری از تکرار محصولات
                    ->published()
                    ->where('price', '>', 0)
                    ->where('stock', '>', 0)
                    ->inRandomOrder()
                    ->take($missingCount)
                    ->pluck('id')
                    ->toArray();
            
                $visitedCategories[$categoryId]['products'] = array_merge($visitedCategories[$categoryId]['products'], $moreProducts);
            }
        }

        $visitedCategoriesJson = json_encode($visitedCategories);

        return response(view('frontend.product', compact('product', 'attributes', 'relatedProducts', 'highlightAttributes', 'suggestedProducts', 'productCategories', 'deliveryFeatures')))
            ->withCookie(cookie()->forever($cookieName, $visitedCategoriesJson));
    }



//     public function paginate($items, $perPage = 100, $page = null, $options = [])
// {
//     $page = $page ?: request('page', 1); // استفاده از request برای دریافت شماره صفحه
//     $items = $items instanceof Collection ? $items : Collection::make($items);
//     return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
// }



    public function paginate($items, $perPage= 100, $page = null, $pageName = "page", $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
    
        return new LengthAwarePaginator(array_values($items->forPage($page, $perPage)
            ->toArray()), $items->count(), $perPage, $page, $options);
    }
    
    public function api(Request $request)
    {
        $product_id = $request->input('product_id');
        $page = $request->input('page', 1);
    
        // اگر فقط شناسه محصول ارسال شده باشد
        if ($product_id) {
            $product = Product::find($product_id);
            if (!$product) {
                return response()->json(['message' => 'محصول مورد نظر یافت نشد'], 404);
            }
    
            $images = [];
            foreach ($product->images as $image) {
                $images[] = asset($image->image);
            }
            $categories = $product->categories->pluck('name')->toArray();
    
            $productArray = [
                'title' => $product->name,
                'subtitle' => '',
                'id' => $product->id,
                'current_price' => $product->special ?: $product->price,
                'old_price' => $product->price,
                'availability' => $product->stock > 0 ? 'instock' : 'null',
                 'categories' => $categories,
                'image_link' => asset($product->image),
                 'image_links' => array_merge([asset($product->image)], $images),
                'page_url' => route('products.show', ['product' => $product->slug]),
                'short_desc' => '',
            ];
    
            return response()->json($productArray);
        }
    
        // در غیر اینصورت، لیست محصولات به صورت پیجینیت شده با قالب نوع اول برگشت داده می‌شود.
        $products = Product::where('status',1)->latest()->get();
        $productArray = [];
    
        foreach ($products as $product) {
            $images = [];
            foreach ($product->images as $image) {
                $images[] = asset($image->image);
            }
            $categories = $product->categories->pluck('name')->toArray();
    
            $productArray[] = [
                'title' => $product->name,
                'subtitle' => '',
                'id' => $product->id,
                'current_price' => $product->special ?: $product->price,
                'old_price' => $product->price,
                'availability' => $product->stock > 0 ? 'instock' : 'null',
                'categories' => $categories,
                'image_link' => asset($product->image),
                'image_links' => array_merge([asset($product->image)], $images),
                'page_url' => route('products.show', ['product' => $product->slug]),
                'short_desc' => '',
            ];
        }
    
        $productCollection = collect($productArray);
    
        $perPage = 100;
        $totalProductsCount = count($productArray);
        $totalPagesCount = ceil($totalProductsCount / $perPage);
    
        $options = ['path' => $request->url(), 'query' => $request->query()];
    
        $products = $this->paginate($productCollection, $perPage, $page, $options);
    
        $response = [
            'count' => $totalProductsCount,
            'total_pages_count' => $totalPagesCount,
            'products' => $products->items(),
        ];
    
        return response()->json($response);
    }
}
