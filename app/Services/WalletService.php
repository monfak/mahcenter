<?php

namespace App\Services;


use App\Models\Wallet;

class WalletService
{
    /**
     * @param int $user_id
     * @return void
     */
    public function initWallet(int $user_id): void
    {
        Wallet::create([
            'user_id' => $user_id,
        ]);
    }
}
