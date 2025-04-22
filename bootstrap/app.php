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
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            // 🛡️ Role-based Access Control
            'role' => \App\Http\Middleware\CheckRole::class,

            // 🔒 Cek status pelanggan saat akses
            'pelanggan.aktif' => \App\Http\Middleware\CheckPelangganStatus::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle error report here (optional)
    })
    ->create();
