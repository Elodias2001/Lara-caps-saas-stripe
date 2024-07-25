<?php

use App\Http\Middleware\RedirectIfNotPremium;
use App\Http\Middleware\RedirectIfNotSubscribe;
use App\Http\Middleware\RedirectIfSubscribed;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'redirect.subscribe' => RedirectIfSubscribed::class, // Si la personne a souscrire à un abonnement redirige le sur le dashboard qu'il n'accède pas aux routes ici
            'redirect.not.premium' => RedirectIfNotPremium::class,
            'redirect.not.subscribe' => RedirectIfNotSubscribe::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'stripe/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
