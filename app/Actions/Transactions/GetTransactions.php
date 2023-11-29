<?php

namespace App\Actions\Transactions;

use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\Auth;

class GetTransactions
{
    public function handle(TransactionRepository $transactionRepository)
    {
        return $transactionRepository->fetch(Auth::user()->id);
    }

}
