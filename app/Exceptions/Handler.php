<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // Customizar a resposta para o erro 429 (ThrottleRequestsException)
        if ($exception instanceof ThrottleRequestsException) {
            // Obter o tempo de espera antes de novas tentativas
            $retryAfter = $exception->getHeaders()['Retry-After'] ?? 60;

            // Renderizar a view personalizada
            return response()->view('errors.429', ['retryAfter' => $retryAfter], 429);
        }

        return parent::render($request, $exception);
    }
}
