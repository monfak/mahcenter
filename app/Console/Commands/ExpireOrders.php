<?php

namespace App\Console\Commands;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire old orders';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $thresholdDate = Carbon::now()->subHours(24);

        // Update orders that are older than 24 hours
        $affectedRows = Order::whereDate('created_at', '<=', $thresholdDate)->pending()->update(['status' => 0]);
    }
}
