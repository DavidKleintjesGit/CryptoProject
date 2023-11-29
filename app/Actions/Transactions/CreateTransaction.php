<?php

namespace App\Actions\Transactions;

use App\Objects\Transaction;
use App\Objects\TransactionEntity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\TransactionRepository;

class CreateTransaction
{
    public function handle(Request $request) : TransactionEntity
    {
        $userId = Auth::User()->id;

        $transactionObject = new Transaction(
            user_id: $userId,
            coinGeckoId: $request->CoinGeckoId,
            price: $request->price,
            quantity: $request->quantity,
            trade: $request->trade
        );

        $transactionRepistory = new TransactionRepository();

        return $transactionRepistory->persist($transactionObject);
    }

}
