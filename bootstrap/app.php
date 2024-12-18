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
        // Redireciona o usuário para a página de login (pasta raiz), caso o mesmo não esteja autenticado
        $middleware->redirectGuestsTo('/'); 
        // Registrando o middleware unidaderestrita
        $middleware->alias([
            'unidaderestrita' => \App\Http\Middleware\UnidadeRestrita::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
