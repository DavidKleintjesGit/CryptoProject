<?php

namespace App\Actions\Coins;

use App\Objects\CoinEntityCollection;
use App\Repositories\CoinRepository;

class GetCoins
{
    public function __construct(){}

    public function handle(CoinRepository $coinRepository): CoinEntityCollection
    {
        return $coinRepository->getCoins();
    }
}

