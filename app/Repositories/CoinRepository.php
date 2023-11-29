<?php

namespace App\Repositories;

use App\Models\Coin as CoinEloquent;
use App\Objects\Coin;
use App\Objects\CoinCollection;

class CoinRepository
{
   public function getCoins()
   {
       $coinsEloquent = CoinEloquent::all();

       $coinsCollection = new CoinCollection();

       $coinsEloquent->map(function ($coin) use ($coinsCollection) {
           $coinObject = new Coin(
               name: $coin->name,
               symbol: $coin->symbol,
               coinGeckoId: $coin->coinGeckoId
           );
           $coinsCollection->addObject($coinObject);
       });

       return $coinsCollection;
   }

}
