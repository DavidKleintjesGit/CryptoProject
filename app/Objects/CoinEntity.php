<?php

namespace App\Objects;

class CoinEntity
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $symbol,
        public readonly string $coinGeckoId
    ){
    }
}
