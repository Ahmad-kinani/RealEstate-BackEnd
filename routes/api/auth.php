<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/login', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::group([
    'prefix' => 'auth',
    'middleware' => 'api',
    'controller' => AuthController::class,
], function () {
    // Route::post('/test', function (Request $request) {
    //     return $request;
    // });

    // Route::middleware('auth:api')->get('/tessss', function (Request $request) {
    //     return $request->user();
    // });

    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::get('me', 'me');
});