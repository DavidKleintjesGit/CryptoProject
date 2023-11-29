<?php

namespace App\Http\Controllers;

use App\Actions\Balance\GetBalance;
use App\Actions\Coingecko\GetCoins;
use App\Actions\Transactions\CreateTransaction;
use App\Actions\Transactions\GetTransactions;
use Illuminate\Http\Request;


class TransactionController extends Controller
{
    public function show()
    {
        return view('balance.index', ['balanceInformation' => dispatch_sync(new GetBalance())]);
    }

    public function store(Request $request)
    {
        $transactionEntity = dispatch_sync(new CreateTransaction($request));

        return view('coins.index', ['coinInformation' => dispatch_sync(new GetCoins())]);
    }


}
