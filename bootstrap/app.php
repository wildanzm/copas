<?php

if (! defined('SIGINT')) {
    define('SIGINT', 2);
}
if (! defined('SIGTERM')) {
    define('SIGTERM', 15);
}
if (! defined('SIGHUP')) {
    define('SIGHUP', 1);
}

use App\Http\Middleware\ProxyHost;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);
        $middleware->prepend(ProxyHost::class);
        $middleware->trustProxies(at: '*');

        $middleware->redirectUsersTo(function (Request $request) {
            /** @var User|null $user */
            $user = $request->user();

            if ($user?->hasRole('student')) {
                return route('student.dashboard');
            } elseif ($user?->hasRole('teacher')) {
                return route('teacher.dashboard');
            }

            return '/';
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
