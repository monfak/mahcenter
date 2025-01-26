<?php

namespace App\Listeners;

use App\Events\ProductPublished;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class UpdateProductSitemap
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ProductPublished $event
     * @return void
     */
    public function handle(ProductPublished $event)
    {
        $products = Product::published()->index()->latest('updated_at')->get();
        $productsSitemap = Sitemap::create();
        foreach ($products as $product) {
            $productsSitemap->add(Url::create('/products/' . $product->slug)
                ->setLastModificationDate($product->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.8));
        }
        $productsSitemap->writeToFile(public_path('../../public_html/sitemap-products.xml'));
    }
}
