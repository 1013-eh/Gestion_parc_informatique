<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // I added an error message if logged in with no email (through link for ex)
        $middleware->redirectGuestsTo(function () {
            session()->flash('error', 'Vous devez d\'abord vous connecter.');
            return route('login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
