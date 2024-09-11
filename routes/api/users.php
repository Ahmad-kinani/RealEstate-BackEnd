<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'users',
    'middleware' =>
    [
        'auth',
        'transactional',
    ],
    'controller' => UserController::class,
], function () {


    Route::post('', 'store');
    Route::get('/{user}', 'show');
    Route::get('', 'list');
    Route::delete('delete', 'destroy');
    Route::put('/{id}', 'update');
});

Route::get('users/userPhoto/{file_path}', [UserController::class, 'getUserPhoto'])
    ->name('userPhoto');
