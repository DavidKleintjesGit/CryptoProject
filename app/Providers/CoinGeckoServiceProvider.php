<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Services\CoinGeckoService;

class CoinGeckoServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(CoinGeckoService::class, function ($app) {
            return new CoinGeckoService();
        });
    }
}
