<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Sale;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateSales extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:sales';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate sales';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
            $orders = Order::query()->with(['products', 'payments' => function($query) {
                $query->where('status', true);
            }])->whereIn('status', [2, 3, 5])->notCalculated()->get();

            foreach ($orders as $order) {
                foreach ($order->products as $product) {
                    DB::beginTransaction();
                    
                    try {
                        
                        $sale = Sale::query()->create([
                            'payment_id' => $order->payments->first()?->id,
                            'order_id' => $order->id,
                            'product_id' => $product->id,
                            'user_id' => $order->user_id,
                            'quantity' => $product->pivot->quantity,
                            'price' => $product->pivot->price,
                            'category_id' => $product->category_id,
                            'created_at' => $order->created_at,
                        ]);
    
                        $totalSalesCount = $product->total_sales_count + $sale->quantity;
                        $orderSalesCount = $product->order_sales_count + 1;
                        
                        $product->timestamps = false;
                        $product->updateQuietly([
                            'total_sales_count' => $totalSalesCount,
                            'order_sales_count' => $orderSalesCount,
                        ]);
                        $product->timestamps = true;
                        
                        $order->update(['is_sale_calculated' => true]);
                        
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                        $this->error('Failed to calculate sales: ' . $e->getMessage());
                    }    
                }
            }
    }
}
