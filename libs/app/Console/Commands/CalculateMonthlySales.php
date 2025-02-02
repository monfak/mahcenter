<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateMonthlySales extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:monthlysales';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate monthly sales';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Product::query()->update(['total_monthly_sales_count' => 0]);

        $salesData = Sale::query()
            ->select('product_id', DB::raw('SUM(quantity) as total_quantity_sold'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('product_id')
            ->get();
        
        foreach ($salesData as $data) {
            DB::table('products')
                ->where('id', $data->product_id)
                ->update(['total_monthly_sales_count' => DB::raw('total_monthly_sales_count + ' . $data->total_quantity_sold)]);
        }
    }
}
