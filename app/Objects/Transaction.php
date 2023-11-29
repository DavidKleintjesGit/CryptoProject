<?php

namespace App\Objects;

class Transaction
{
    public function __construct(
        public readonly string $user_id,
        public readonly string $coinGeckoId,
        public readonly string $price,
        public readonly string $quantity,
        public readonly string $trade,
    ){
    }
}
