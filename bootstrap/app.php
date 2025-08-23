<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\UseAdminSession;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // added 
        // $middleware->web([
        //     \Illuminate\Cookie\Middleware\EncryptCookies::class,
        //     \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        //     \Illuminate\Session\Middleware\StartSession::class,
        //     \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        //     // \App\Http\Middleware\VerifyCsrfToken::class,
        // ]);

        //Lets you use 'set_session' as shorthand for your custom middleware
        $middleware->alias([
            'set_session' => UseAdminSession::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'payment-callback',
            // or wildcard patterns like 'payment/*/callback'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
