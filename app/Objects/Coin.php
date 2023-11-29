<?php

namespace App\Objects;

class Coin
{
    public function __construct(
        public readonly string $name,
        public readonly string $symbol,
        public readonly string $coinGeckoId
    ){
    }
}
