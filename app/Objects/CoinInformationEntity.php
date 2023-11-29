<?php

namespace App\Objects;

class CoinInformationEntity
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $currentPrice,
        public readonly string $priceChange1h,
        public readonly string $priceChange24h,
        public readonly string $priceChange7d,

    ){
    }
}
