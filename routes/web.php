<?php

use Illuminate\Support\Facades\Route;
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
    return redirect('/login');
 });
 
 Auth::routes();
 



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/deposit', [App\Http\Controllers\AccountController::class, 'deposit'])->name('deposit');

Route::post('/deposit', [App\Http\Controllers\AccountController::class, 'saveDeposit'])->name('saveDeposit');

Route::get('/withdraw', [App\Http\Controllers\AccountController::class, 'withdraw'])->name('withdraw');

Route::post('/withdraw', [App\Http\Controllers\AccountController::class, 'saveWithdraw'])->name('saveWithdraw');

Route::get('/transfer', [App\Http\Controllers\AccountController::class, 'transfer'])->name('transfer');

Route::post('/transfer', [App\Http\Controllers\AccountController::class, 'saveTransfer'])->name('saveTransfer');

Route::get('/statement', [App\Http\Controllers\AccountController::class, 'statement'])->name('statement');
