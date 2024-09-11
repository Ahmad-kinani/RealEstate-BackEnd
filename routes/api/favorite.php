<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RealEstateController;
use App\Http\Controllers\UserController;
use App\Models\Favorite;
use App\Models\RealEstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'favorite',
    'middleware' =>
    [
        'auth',
        'transactional',
    ],
    'controller' => FavoriteController::class,
], function () {


    Route::post('', 'store');
    Route::delete('delete', 'destroy');
});