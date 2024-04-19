<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

    public function render($request, Throwable $e)
    {
        if ($e instanceof CustomException) {
            if ($request->wantsJson()) {
                return response()->json([
                    "code" => $e->getCustomCode(),
                    'message' => $e->getMessage()
                ], $e->getCode());
            }

            $statusCode = $e->getCustomCode();
            return match ($statusCode) {
                404 => response()->view('errors.404', compact('e'), 404),
                500 => response()->view('errors.500', compact('e'), 500),
                default => parent::render($request, $e),
            };
        }

        return parent::render($request, $e);
    }
}
