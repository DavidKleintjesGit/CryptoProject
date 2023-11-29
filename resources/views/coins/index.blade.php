@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-8 p-8 bg-white shadow-md rounded">
        <h1 class="text-2xl font-bold mb-4">Cryptocurrency Price Table</h1>

        <table class="w-full border-collapse">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-300">Cryptocurrency</th>
                <th class="py-2 px-4 border-b border-gray-300">Current Price (USD)</th>
                <th class="py-2 px-4 border-b border-gray-300">Price Change (1hr)</th>
                <th class="py-2 px-4 border-b border-gray-300">Price Change (24hr)</th>
                <th class="py-2 px-4 border-b border-gray-300">Price Change (7d)</th>
                <th class="py-2 px-4 border-b border-gray-300">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($coinInformation->list as $coinInfo)
                <tr class="hover:bg-gray-50 transition duration-300">
                    <td class="py-2 px-4 border-b border-gray-300">
                        {{ $coinInfo->name }}
                    </td>
                    <td class="py-2 px-4 border-b border-gray-300">${{ number_format($coinInfo->currentPrice, 2) }}</td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ $coinInfo->priceChange1h }}%</td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ $coinInfo->priceChange24h }}%</td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ $coinInfo->priceChange7d }}%</td>
                    <td class="py-2 px-4 border-b border-gray-300">
                        <form
                            action="/transactions"
                            method="POST">
                            @csrf
                            @method('post')
                            <input
                                type="number"
                                name="quantity"
                                value="0"
                                min="1">
                            <input
                                type="hidden"
                                name="CoinGeckoId"
                                value="{{ strtolower($coinInfo->name) }}">
                            <input
                                type="hidden"
                                name="trade"
                                value="1">
                            <input
                                type="hidden"
                                name="price"
                                value="{{ number_format($coinInfo->currentPrice, 2) }}">
                            <button
                                type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded-md">
                                    Buy
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
