<?php

namespace App\Actions\Coins;

use App\Repositories\CoinRepository;
use App\Objects\CoinCollection;

class GetCoins
{
    public function handle(CoinRepository $coinRepository): CoinCollection
    {
        return $coinRepository->getCoins();
    }
}

