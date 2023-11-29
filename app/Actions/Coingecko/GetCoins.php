<?php

namespace App\Actions\Coingecko;

use App\Services\CoinGeckoService;

class GetCoins
{
    public function __construct(){}

    public function handle(CoinGeckoService $coinGeckoService)
    {
        return $coinGeckoService->getCoins();
    }

}
