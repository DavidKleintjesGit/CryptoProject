@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8 p-8 bg-white shadow-md rounded">
        <h1 class="text-2xl font-bold mb-4">Balance Information</h1>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse">
                <thead>
                <tr>
                    <th class="px-4 py-2">Coin</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Value</th>
                    <th class="px-4 py-2">Gain/Loss</th>
                </tr>
                </thead>
                <tbody>
                @foreach($balanceInformation->list as $balance)
                    <tr class="border-t border-gray-300 hover:bg-gray-100">
                        <td class="px-4 py-2">{{ $balance->coinGeckoId }}</td>
                        <td class="px-4 py-2">{{ $balance->quantity }}</td>
                        <td class="px-4 py-2">{{ $balance->value }}</td>
                        <td class="px-4 py-2 {{ $balance->gainLoss < 0 ? 'text-red-500' : 'text-green-500' }}">
                            {{ $balance->gainLoss }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
