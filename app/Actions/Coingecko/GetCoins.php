<?php

namespace App\Actions\Coingecko;

use App\Objects\CoinInformationEntityCollection;
use App\Services\CoinGeckoService;

class GetCoins
{
    public function __construct(){}

    public function handle(CoinGeckoService $coinGeckoService): CoinInformationEntityCollection
    {
        return $coinGeckoService->getCoins();
    }

}
