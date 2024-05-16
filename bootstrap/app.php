<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web: __DIR__.'/../routes/web.php',
        // api: __DIR__.'/../routes/api.php',
        using: function (Illuminate\Routing\Router $router) {
            $router->middleware("api")
              ->prefix("api")
              ->group (base_path("routes/api.php"));
            $router->middleware("web")
              ->group (base_path("routes/web.php"));
            $router->middleware("web")
              ->prefix("admin")
              ->group (base_path("routes/admin.php"));
          },
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
