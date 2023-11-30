<?php

namespace App\Objects\Coins;

class CoinInformation
{
    public function __construct(
        public readonly string $name,
        public readonly string $currentPrice,
        public readonly string $priceChange1h,
        public readonly string $priceChange24h,
        public readonly string $priceChange7d,

    ){
    }
}
