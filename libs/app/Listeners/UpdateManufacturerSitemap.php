<?php

namespace App\Listeners;

use App\Events\ManufacturerPublished;
use App\Models\Manufacturer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class UpdateManufacturerSitemap
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
     * @param ManufacturerPublished $event
     * @return void
     */
    public function handle(ManufacturerPublished $event)
    {
        $manufacturers = Manufacturer::latest('updated_at')->get();
        $manufacturersSitemap = Sitemap::create();
        foreach ($manufacturers as $manufacturer) {
            $manufacturersSitemap->add(Url::create('/manufacturers/' . $manufacturer->slug)
                ->setLastModificationDate($manufacturer->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.8));
        }
        $manufacturersSitemap->writeToFile(public_path('../../public_html/sitemap-manufacturers.xml'));
    }
}
