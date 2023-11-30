<?php

namespace App\Objects\Coins;

class CoinInformationCollection
{
    private array $array;

    public function __construct(CoinInformation ...$coinInformation)
    {
        $this->array = $coinInformation;
    }

    public function addObject(CoinInformation $coinInformation): void
    {
        $this->list[] = $coinInformation;
    }

}
