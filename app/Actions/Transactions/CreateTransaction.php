<?php

namespace App\Actions\Transactions;

use App\Objects\Transaction;
use App\Objects\TransactionEntity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\TransactionRepository;

class CreateTransaction
{
    public function __construct(
        private readonly Request $request
    ){
    }

    public function handle(TransactionRepository $transactionRepository): TransactionEntity
    {
        $userId = Auth::User()->id;

        $transactionObject = new Transaction(
            user_id: $userId,
            coinGeckoId: $this->request->CoinGeckoId,
            price: $this->request->price,
            quantity: $this->request->quantity,
            trade: $this->request->trade
        );

        return $transactionRepository->persist($transactionObject);
    }

}
