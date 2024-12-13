<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\walletsController;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/About', [HomeController::class, 'about'])->name('about');


route::prefix("user")->middleware("auth")->group(function(){
    // wallet
    Route::get('/wallets', [walletsController::class, 'index'])->name('wallets');
    Route::post('/Transaction', [walletsController::class, 'Transaction'])->name('Transaction');

});


// Login 
Route::get('/Register', [AuthController::class, 'Register'])->name('Register');
Route::post('/Store', [AuthController::class, 'submitRegister'])->name('Store_User');
Route::get('/Login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');