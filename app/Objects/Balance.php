<?php

namespace App\Objects;


class Balance
{
    public function __construct(
        public readonly string $user_id,
        public readonly string $coinGeckoId,
        public readonly string $value,
        public readonly string $quantity,
        public readonly string $gainLoss
    ){
    }
}
