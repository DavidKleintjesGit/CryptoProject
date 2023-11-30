<?php

namespace App\Objects\Coins;

class Coin
{
    public function __construct(
        public readonly string $name,
        public readonly string $symbol,
        public readonly string $coinGeckoId
    ){
    }
}
