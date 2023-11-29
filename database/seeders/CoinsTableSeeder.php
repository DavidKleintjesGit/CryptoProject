<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Coin;

class CoinsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('coins')->insert([
            'name' => 'Bitcoin',
            'symbol' => 'btc',
            'coinGeckoId' => 'bitcoin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('coins')->insert([
            'name' => 'Ethereum',
            'symbol' => 'eth',
            'coinGeckoId' => 'ethereum',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('coins')->insert([
            'name' => 'Cardano',
            'symbol' => 'btc',
            'coinGeckoId' => 'cardano',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('coins')->insert([
            'name' => 'Tether',
            'symbol' => 'btc',
            'coinGeckoId' => 'tether',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
