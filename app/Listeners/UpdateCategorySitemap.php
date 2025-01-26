<?php

namespace App\Listeners;

use App\Events\CategoryPublished;
use App\Models\Category;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class UpdateCategorySitemap
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
     * @param CategoryPublished $event
     * @return void
     */
    public function handle(CategoryPublished $event)
    {
        $categories = Category::published()->latest('updated_at')->get();
        $categoriesSitemap = Sitemap::create();
        foreach ($categories as $category) {
            if($category->parent_id === null) {
                $categoriesSitemap->add(Url::create('/category/decs/' . $category->slug)
                    ->setLastModificationDate($category->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.8));
            } else {
                $categoriesSitemap->add(Url::create('/categories/' . $category->slug)
                    ->setLastModificationDate($category->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.8));
            }
        }
        $categoriesSitemap->writeToFile(public_path('../../public_html/sitemap-categories.xml'));
    }
}
