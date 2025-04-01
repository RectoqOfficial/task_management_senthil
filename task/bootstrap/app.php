<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminAuthenticated;
use App\Http\Middleware\EmployeeAuthenticated;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Registering middleware alias
        $middleware->alias([
            'admin.auth' => AdminAuthenticated::class, // Correct middleware alias
            'employee.auth' => EmployeeAuthenticated::class, // Correct middleware alias
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    }) // <-- Add semicolon here
    ->create();
