@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8 p-8 bg-white shadow-md rounded">
        <h1 class="text-2xl font-bold mb-4">Balance Information</h1>

        <table class="w-full border-collapse">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-300">Coin</th>
                <th class="py-2 px-4 border-b border-gray-300">Quantity</th>
                <th class="py-2 px-4 border-b border-gray-300">Value</th>
                <th class="py-2 px-4 border-b border-gray-300">Gain/Loss</th>
            </tr>
            </thead>
            <tbody>
            @foreach($balanceInformation->list as $balance)
                <tr class="hover:bg-gray-50 transition duration-300">
                    <td class="py-2 px-4 border-b border-gray-300">
                        {{ $balance->coinGeckoId }}
                    </td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ $balance->quantity }}</td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ $balance->value }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 {{ $balance->gainLoss < 0 ? 'text-red-500' : 'text-green-500' }}">
                        {{ $balance->gainLoss }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
