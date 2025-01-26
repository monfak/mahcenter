<?php

namespace App\Observers;

use App\Events\ManufacturerPublished;
use App\Models\Manufacturer;

class ManufacturerObserver
{
    /**
     * Handle the Manufacturer "created" event.
     */
    public function created(Manufacturer $manufacturer): void
    {
        if($manufacturer->status)
        {
            event(new ManufacturerPublished($manufacturer));
        }
    }

    /**
     * Handle the Manufacturer "updated" event.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return void
     */
    public function updated(Manufacturer $manufacturer): void
    {
        event(new ManufacturerPublished($manufacturer));
    }

    /**
     * Handle the Manufacturer "deleted" event.
     */
    public function deleted(Manufacturer $manufacturer): void
    {
        event(new ManufacturerPublished($manufacturer));
    }

    /**
     * Handle the Manufacturer "restored" event.
     */
    public function restored(Manufacturer $manufacturer): void
    {
        //
    }

    /**
     * Handle the Manufacturer "force deleted" event.
     */
    public function forceDeleted(Manufacturer $manufacturer): void
    {
        //
    }
}
