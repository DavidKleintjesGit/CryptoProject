<?php

namespace App\Actions\Balance;

use App\Actions\Coingecko\GetCoins;
use App\Actions\Transactions\GetTransactions;
use App\Objects\Balance;
use App\Objects\BalanceCollection;
use Illuminate\Support\Facades\Auth;

class GetBalance
{
    public function __construct(){}

    public function handle()
    {
        return $this->calculateBalance();
    }

    public function calculateBalance(): BalanceCollection
    {
        $coinBalances = $this->sumTransactions();

        if (!$coinBalances){
            return new BalanceCollection();
        }

        $currentMarketPrice = $this->getCurrentMarketPrice();
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
                value: $coin['value'],
                quantity: $coin['quantity'],
                gainLoss: $coin['gainLoss'],
            );
            $balanceCollection->addObject($balanceObject);
        });

        return $balanceCollection;
    }

    public function sumTransactions(): array|bool
    {
        $transactionEntityCollection = dispatch_sync(new GetTransactions());
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

    public function getCurrentMarketPrice(): array
    {
        $coinInformationCollection = dispatch_sync(new GetCoins());
        $currentMarketPrice = [];

        foreach ($coinInformationCollection->list as $coin){
            $coinGeckoId = strtolower($coin->name);
            $price = $coin->currentPrice;

            $currentMarketPrice[$coinGeckoId] = $price;
        }

        return $currentMarketPrice;
    }

}
