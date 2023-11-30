<?php

namespace App\Objects\Transactions;

class TransactionCollection
{
    private array $array;

    public function __construct(Transaction ...$Transaction)
    {
        $this->array = $Transaction;
    }

    public function addObject(Transaction $Transaction): void
    {
        $this->list[] = $Transaction;
    }


}
