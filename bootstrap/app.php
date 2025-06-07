<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\ApiKeyMiddleware;
use App\Http\Middleware\ApiAuthenticate;
use App\Http\Middleware\AppUrlMiddleware;
use App\Http\Middleware\BasicAuthMiddleware;
use App\Http\Middleware\WebAuthenticate;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Add global middleware to automatically set correct URLs
        $middleware->prepend(AppUrlMiddleware::class);
        
        // Register API authentication middlewares
        $middleware->alias([
            'api.key' => ApiKeyMiddleware::class,
            'api.auth' => ApiAuthenticate::class,
            'basic.auth' => BasicAuthMiddleware::class,
            'web.auth' => WebAuthenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
