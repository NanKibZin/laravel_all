<?php

use App\Http\Controllers\StudentController;
use App\Http\Middleware\adminAuthenticate;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AdminRedirect;
use App\Http\Middleware\ParentMiddleware;
use App\Http\Middleware\StudentMiddleware;
use App\Http\Middleware\TeacherMiddleware;
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
            'admin'=>AdminMiddleware::class,
            'student'=>StudentMiddleware::class,
            'parent'=>ParentMiddleware::class,
            'teacher'=>TeacherMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
