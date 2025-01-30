<?php

namespace App\Services;


use App\Models\Product;

class ProductService
{
    protected $stringService ;

    public function __construct()
    {
        $this->stringService = app(StringService::class) ;
    }
    public function setAllDevTitles()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $product->dev_title = $this->stringService->setDevTitle($product->name,true);
            $product->save();
        }
    }
}
