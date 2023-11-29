<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\TransactionController;
use App\Repositories\TransactionRepository;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {


    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/coins', [CoinController::class, 'show']);

    Route::get('/balance', [TransactionController::class, 'show']);

    Route::post('/transactions', [TransactionController::class, 'store']);

});
