<?php

namespace App\Http\Controllers;

use App\Actions\Coingecko\GetCoins;

class CoinController extends Controller
{
    public function show()
    {
        return view('coins.index', ['coinInformation' => dispatch_sync(new GetCoins())]);
    }

}
