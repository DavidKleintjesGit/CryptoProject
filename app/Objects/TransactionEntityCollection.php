<?php

namespace App\Objects;

class TransactionEntityCollection
{
    private array $array;

    public function __construct(TransactionEntity ...$TransactionEntity)
    {
        $this->array = $TransactionEntity;
    }

    public function addEntity(TransactionEntity $TransactionEntity): void
    {
        $this->list[] = $TransactionEntity;
    }


}
