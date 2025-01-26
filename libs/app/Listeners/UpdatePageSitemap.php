<?php

namespace App\Listeners;

use App\Models\Page;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class UpdatePageSitemap
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
        $pages = Page::published()->latest('updated_at')->get();
        $pagesSitemap = Sitemap::create();
        foreach ($pages as $page) {
            $pagesSitemap->add(Url::create('/page/' . $page->slug)
                ->setLastModificationDate($page->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.8));
        }
        $pagesSitemap->writeToFile(public_path('../../public_html/sitemap-pages.xml'));
    }
}
