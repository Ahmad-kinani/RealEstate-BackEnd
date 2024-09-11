<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CurrencyFactorController;
use App\Http\Controllers\MethodPaymentController;
use App\Http\Controllers\RealEstateController;
use App\Http\Controllers\UserController;
use App\Models\MethodPayment;
use App\Models\RealEstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'settings',
    'middleware' =>
    [
        'api',
        'transactional',
    ],
], function () {


    Route::get('getCurrencies', [CurrencyController::class, 'index']);
    Route::get('getMethodPayments', [MethodPaymentController::class, 'index']);
    Route::get('getCurrencyFactors', [CurrencyFactorController::class, 'index']);
});

// Route::get('users/userPhoto/{file_path}', [UserController::class, 'getUserPhoto'])
//     ->name('userPhoto');