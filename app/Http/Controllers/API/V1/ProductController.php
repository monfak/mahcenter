<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProducts(Request $request)
    {
        $page = $request->get('page', 1);
        $itemsPerPage = $request->get('item_per_page', 50);
        $query = Product::query()->where('price', '>', 0);
        $products = $query->published()->paginate($itemsPerPage, ['*'], 'page', $page);
        return new ProductCollection($products);
    }
}
