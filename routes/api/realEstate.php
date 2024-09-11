<?php

use App\Http\Controllers\RealEstateController;
use App\Http\Controllers\UserController;
use App\Models\RealEstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'realEstate',
    'middleware' =>
    [
        'auth',
        'transactional',
    ],
    'controller' => RealEstateController::class,
], function () {

    Route::post('', 'store');
    Route::delete('delete', 'destroy');
    Route::put('/{id}', 'update');
});

Route::group([
    'prefix' => 'realEstate',
    'middleware' =>
    [
        'transactional',
    ],
    'controller' => RealEstateController::class,
], function () {
    Route::get('/{RealEstate}', 'show');
    Route::get('', 'list');
});

Route::get('realEstate/realEstatePhoto/{file_path}', [RealEstateController::class, 'getRealEstatePhoto'])
    ->name('realEstatePhoto');
