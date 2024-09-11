<?php

use App\Http\Controllers\InvoiceController;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'invoices',
    'middleware' =>
    [
        'auth',
        'transactional',
    ],
    'controller' => InvoiceController::class,
], function () {
    Route::post('', 'store');
    Route::get('/{invoice}', 'show');
    Route::get('', 'index');
});