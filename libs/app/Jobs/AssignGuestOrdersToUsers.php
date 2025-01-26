<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\User;
use App\Models\Address;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AssignGuestOrdersToUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $guestOrders = Order::whereNull('user_id')->where('created_at', '<', Carbon::now()->subHour())->get();

        foreach ($guestOrders as $order) {
            DB::transaction(function () use ($order) {
                $user = User::query()->where('mobile', $order->mobile)->first();

                if ($user) {
                    $order->update(['user_id' => $user->id]);
                } else {
                    $user = User::query()->create([
                        'mobile' => $order->mobile,
                        'first_name' => $order->first_name,
                        'last_name' => $order->last_name,
                        'name' => $order->name,
                    ]);
                    $order->update(['user_id' => $user->id]);
                }

                $address = Address::query()->where('id', $order->address_id)->first();
                
                if ($address && $address->user_id === null) {
                    $address->update(['user_id' => $user->id]);
                }
            });
        }
    }
}
