<?php

namespace App\Repositories;

use App\Models\Transaction as TransactionEloquent;
use App\Objects\Transactions\TransactionEntity;
use App\Objects\Transactions\TransactionEntityCollection;

class TransactionRepository
{
    public function fetch($id): TransactionEntityCollection
    {
        $transactionsEloquent = TransactionEloquent::where('user_id', $id)->get();

        $transactionEntityCollection = new TransactionEntityCollection();

        $transactionsEloquent->map(function ($transaction) use ($transactionEntityCollection) {
            $transactionEntity = new TransactionEntity(
                id: $transaction->id,
                user_id: $transaction->user_id,
                coinGeckoId: $transaction->coinGeckoId,
                price: $transaction->price,
                quantity: $transaction->quantity,
                trade: $transaction->trade
            );
            $transactionEntityCollection->addEntity($transactionEntity);
        });

        return $transactionEntityCollection;

    }

    public function persist($transactionObject): TransactionEntity
    {
        $transaction = new TransactionEloquent();
        $transaction->user_id = $transactionObject->user_id;
        $transaction->coinGeckoId = $transactionObject->coinGeckoId;
        $transaction->price = str_replace(',', '', $transactionObject->price);
        $transaction->price = (float)$transaction->price;
        $transaction->quantity = $transactionObject->quantity;
        $transaction->trade = $transactionObject->trade;

        $transaction->save();

        return new TransactionEntity(
            id: $transaction->id,
            user_id: $transaction->user_id,
            coinGeckoId: $transaction->coinGeckoId,
            price: $transaction->price,
            quantity: $transaction->quantity,
            trade: $transaction->trade
        );
    }
}
