<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;

return Application::configure(basename(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Seus middlewares padrão aqui
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Captura de 404 para API
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 404,
                    'error' => 'O recurso solicitado não foi encontrado.'
                ], 404);
            }
        });

        // Captura de falhas de validação (422) para API
        $exceptions->render(function (ValidationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 422,
                    'error' => 'Dados inválidos.',
                    'messages' => $e->errors()
                ], 422);
            }
        });
    })->create();