<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'UserType' => \App\Http\Middleware\UserType::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {})
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('lifespan:check')->everyMinute();
        $schedule->command('lifespan:overdue')->everyMinute();
        $schedule->command('maintenance:overdue')->everyMinute();
        $schedule->command('maintenance:check')->everyMinute();
    })
    ->create();
