<?php

namespace App\Objects\Transactions;

class TransactionEntity
{
    public function __construct(
        public readonly string $id,
        public readonly string $user_id,
        public readonly string $coinGeckoId,
        public readonly string $price,
        public readonly string $quantity,
        public readonly string $trade,
    ){
    }
}
