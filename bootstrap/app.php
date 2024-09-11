<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {

            foreach (glob(base_path('routes/api/*.php')) as $file)
                Route::middleware('api')
                    ->prefix('api')
                    ->group($file);
        },
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api/*',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => \App\Http\Middleware\AuthenticateMiddleware::class,
            'transactional' => \App\Http\Middleware\TransactionalMiddleware::class,
        ]);
        // $middleware->append(\App\Http\Middleware\SetUserLocale::class);
    })
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();