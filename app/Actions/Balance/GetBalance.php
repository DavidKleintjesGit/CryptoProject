<?php

namespace App\Actions\Balance;

use App\Objects\Balances\BalanceCollection;
use App\Repositories\CoinRepository;
use App\Repositories\TransactionRepository;
use App\Services\CoinGeckoService;
use Illuminate\Support\Facades\Auth;

class GetBalance
{
    public function __construct(){}

    public function handle(CoinGeckoService $coinGeckoService, TransactionRepository $transactionRepository, CoinRepository $coinRepository): ?BalanceCollection
    {
        $id = Auth::user()->id;
        $CoinEntityCollection = $coinRepository->getCoins();
        $coinInformationEntityCollection = $coinGeckoService->getCoins();

        $balanceCollection = new BalanceCollection();

        foreach ($CoinEntityCollection->list as $coin) {
            $currentMarketPrice = $this->getCurrentMarketPrice($coin->coinGeckoId, $coinInformationEntityCollection);
            $balanceObject = $transactionRepository->calculateBalance($coin, $id, $currentMarketPrice);

            if ($balanceObject){
                $balanceCollection->addObject($balanceObject);
            }
        }

        return $balanceCollection;
    }

    public function getCurrentMarketPrice($id, $coinInformationEntityCollection): int
    {
        foreach ($coinInformationEntityCollection->list as $coin){
            if ($id == $coin->id){
                $currentMarketPrice = $coin->currentPrice;
            }
        }

        return $currentMarketPrice;
    }

}
