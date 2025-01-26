<?php

namespace App\Listeners;

use App\Models\Article;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Page;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Sitemap;

class UpdateIndexSitemap
{
    /**
     * Create the event listener.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $article        = Article::published()->latest('updated_at')->first();
        $category       = Category::published()->latest('updated_at')->first();
        $manufacturer   = Manufacturer::latest('updated_at')->first();
        $page           = Page::published()->latest('updated_at')->first();
        $product        = Product::published()->latest('updated_at')->first();
        $sitemap = SitemapIndex::create()
            ->add(Sitemap::create('/sitemap-blog.xml')->setLastModificationDate($article->updated_at))
            ->add(Sitemap::create('/sitemap-categories.xml')->setLastModificationDate($category->updated_at))
            ->add(Sitemap::create('/sitemap-manufacturers.xml')->setLastModificationDate($manufacturer->updated_at))
            ->add(Sitemap::create('/sitemap-pages.xml')->setLastModificationDate($page->updated_at))
            ->add(Sitemap::create('/sitemap-products.xml')->setLastModificationDate($product->updated_at));
        $sitemap->writeToFile(public_path('../../public_html/sitemap.xml'));
    }
}
