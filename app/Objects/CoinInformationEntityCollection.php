<?php

namespace App\Objects;

class CoinInformationEntityCollection
{
    private array $array;

    public function __construct(CoinInformationEntity ...$CoinInformationEntity)
    {
        $this->array = $CoinInformationEntity;
    }

    public function addEntity(CoinInformationEntity $CoinInformationEntity): void
    {
        $this->list[] = $CoinInformationEntity;
    }
}
