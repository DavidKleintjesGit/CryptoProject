<?php

namespace App\Services;

use App\Actions\Coins\GetCoinInformation;
use App\Actions\Coins\GetCoins;
use App\Objects\Coins\CoinInformationEntity;
use App\Objects\Coins\CoinInformationEntityCollection;
use Illuminate\Support\Facades\Http;


class CoinGeckoService
{
    public function getCoins(): CoinInformationEntityCollection
    {
        $coinsInformation = $this->apiCall();

        $CoinInformationEntityCollection = new CoinInformationEntityCollection();

        $coinsInformation->map(function ($coin) use ($CoinInformationEntityCollection) {
            $CoinInformationEntity = new CoinInformationEntity(
                id: $coin->id,
                name: $coin->name,
                currentPrice: $coin->current_price,
                priceChange1h: round($coin->price_change_percentage_1h_in_currency, 2),
                priceChange24h: round($coin->price_change_percentage_24h_in_currency, 2),
                priceChange7d: round($coin->price_change_percentage_7d_in_currency,2)
            );
            $CoinInformationEntityCollection->addEntity($CoinInformationEntity);
        });

       return $CoinInformationEntityCollection;
    }

    public function apiCall()
    {
        $coinGeckoIds = $this->getCoinGeckoIds();
        $response = Http::get('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids='. $coinGeckoIds .'&order=market_cap_desc&per_page=100&page=1&sparkline=false&price_change_percentage=1h%2C24h%2C7d&locale=en&x_cg_demo_api_key=CG-RJU7LAB8JswznppFzQhg2kkX');

        return collect(json_decode($response->body()));
    }

    public function getCoinGeckoIds()
    {
        $coinCollection = dispatch_sync(new GetCoins());

        $coinGeckoIds = [];

        foreach ($coinCollection->list as $coin)
        {
            $coinGeckoIds[] = $coin->coinGeckoId;
        }

        return implode('%2C%20', $coinGeckoIds);
    }

}
