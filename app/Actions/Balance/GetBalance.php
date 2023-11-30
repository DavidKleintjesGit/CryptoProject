<?php

namespace App\Actions\Balance;

use App\Actions\Coingecko\GetCoins;
use App\Actions\Transactions\GetTransactions;
use App\Objects\Balances\Balance;
use App\Objects\Balances\BalanceCollection;
use App\Repositories\TransactionRepository;
use App\Services\CoinGeckoService;
use Illuminate\Support\Facades\Auth;

class GetBalance
{


    public function __construct(){}

    public function handle(CoinGeckoService $coinGeckoService, TransactionRepository $transactionRepository): BalanceCollection
    {
        $coinBalances = $this->sumTransactions($transactionRepository);

        if (!$coinBalances){
            return new BalanceCollection();
        }

        $currentMarketPrice = $this->getCurrentMarketPrice($coinGeckoService);
        $balance = [];

        foreach ($coinBalances as $coinGeckoId => $coin){
            $id = $coinGeckoId;
            $quantity = $coin['quantity'];
            $value = $coin['value'];

            $coinBalance = $currentMarketPrice[$id] * $quantity;
            $coinGainLoss = $value - $currentMarketPrice[$id] * $quantity;

            $balance[$coinGeckoId] = [
                'coinGeckoId' => $id,
                'value' => $coinBalance,
                'quantity' => $quantity,
                'gainLoss' => $coinGainLoss
            ];
        }

        $balanceCollection = new BalanceCollection();
        $balance = collect($balance);

        $balance->map(function ($coin) use ($balanceCollection) {
            $id = Auth::user()->id;
            $balanceObject = new Balance(
                user_id: $id,
                coinGeckoId: $coin['coinGeckoId'],
                value: '$' . number_format($coin['value'], 2, '.', ','),
                quantity: round($coin['quantity'], 0),
                gainLoss: '$' . number_format($coin['gainLoss'], 2, '.', ','),
            );
            $balanceCollection->addObject($balanceObject);
        });

        return $balanceCollection;
    }


    public function sumTransactions($transactionRepository): array|bool
    {
        $transactionEntityCollection = $transactionRepository->fetch(Auth::user()->id);
        $totalAmounts = [];

        if (!isset($transactionEntityCollection->list)) {
            return false;
        }

        foreach ($transactionEntityCollection->list as $transaction)
        {
            $coinGeckoId = $transaction->coinGeckoId;
            $quantity = $transaction->quantity;
            $price = $transaction->price;

            if (!isset($totalAmounts[$coinGeckoId])){
                $totalAmounts[$coinGeckoId] = [
                    'quantity' => $quantity,
                    'value' => $quantity * $price
                ];
            } else {
                $totalAmounts[$coinGeckoId]['quantity'] += $quantity;
                $totalAmounts[$coinGeckoId]['value'] += $quantity * $price;
            }
        }

        return $totalAmounts;
    }

    public function getCurrentMarketPrice($coinGeckoService): array
    {
        $CoinInformationEntityCollection = $coinGeckoService->getCoins();
        $currentMarketPrice = [];

        foreach ($CoinInformationEntityCollection->list as $coin){
            $coinGeckoId = strtolower($coin->name);
            $price = $coin->currentPrice;

            $currentMarketPrice[$coinGeckoId] = $price;
        }

        return $currentMarketPrice;
    }

}
