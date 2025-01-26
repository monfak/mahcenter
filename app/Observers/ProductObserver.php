<?php

namespace App\Observers;

use App\Events\ProductPublished;
use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        if($product->status)
        {
            event(new ProductPublished($product));
        }
        $manufacturer = $product->manufacturer()->withCount(['products' => function($query) {
            $query->published();
        }])->first();
        if($manufacturer) {
            $manufacturer->update(['total_products' => $manufacturer->products_count]);
        }
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        if($product->wasChanged('status'))
        {
            event(new ProductPublished($product));
        }
        $manufacturer = $product->manufacturer()->withCount(['products' => function($query) {
            $query->published();
        }])->first();
        if($manufacturer) {
            $manufacturer->update(['total_products' => $manufacturer->products_count]);
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        event(new ProductPublished($product));
        $manufacturer = $product->manufacturer()->withCount(['products' => function($query) {
            $query->published();
        }])->first();
        if($manufacturer) {
            $manufacturer->update(['total_products' => $manufacturer->products_count]);
        }
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
