<?php

namespace App\Repositories;

use App\Models\Coin as CoinEloquent;
use App\Objects\Coins\CoinEntity;
use App\Objects\Coins\CoinEntityCollection;

class CoinRepository
{
   public function getCoins(): CoinEntityCollection
   {
       $coinsEloquent = CoinEloquent::all();

       $CoinEntityCollection = new CoinEntityCollection();

       $coinsEloquent->map(function ($coin) use ($CoinEntityCollection) {
           $CoinEntity = new CoinEntity(
               id: $coin->id,
               name: $coin->name,
               symbol: $coin->symbol,
               coinGeckoId: $coin->coinGeckoId
           );
           $CoinEntityCollection->addEntity($CoinEntity);
       });

       return $CoinEntityCollection;
   }

}
