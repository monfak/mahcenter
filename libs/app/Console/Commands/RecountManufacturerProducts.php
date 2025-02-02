<?php

namespace App\Console\Commands;

use App\Models\Manufacturer;
use Illuminate\Console\Command;

class RecountManufacturerProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recount:manufacturer-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recount manufacturer products';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $manufacturers = \App\Models\Manufacturer::withCount(['products' => function($query) {
            $query->where('stock', '>', 0)->where('price', '>', 0)->published();
        }])->get();
        foreach($manufacturers as $manufacturer) {
            $manufacturer->timestamps = false;
            $manufacturer->updateQuietly(['total_products' => $manufacturer->products_count]);
            $manufacturer->timestamps = true;
        }
    }
}
