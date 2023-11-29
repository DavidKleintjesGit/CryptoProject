<?php

namespace App\Http\Controllers;

use App\Actions\Balance\GetBalance;
use App\Actions\Transactions\CreateTransaction;
use App\Actions\Transactions\GetTransactions;


class TransactionController extends Controller
{
    public function show()
    {
        return view('balance.index', ['balanceInformation' => dispatch_sync(new GetBalance())]);
    }

    public function store()
    {
        $transactionEntity = dispatch_sync(new CreateTransaction());

        return response()->json($transactionEntity);
    }


}