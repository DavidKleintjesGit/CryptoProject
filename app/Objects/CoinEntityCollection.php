<?php

namespace App\Objects;

class CoinEntityCollection
{
    private array $array;

    public function __construct(CoinEntity ...$CoinEntity)
    {
        $this->array = $CoinEntity;
    }

    public function addEntity(CoinEntity $TransactionEntity): void
    {
        $this->list[] = $TransactionEntity;
    }
}
