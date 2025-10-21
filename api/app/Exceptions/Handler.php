<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use \Throwable;

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
        $this->renderable(function (Throwable $e, Request $request) {

            if ($e instanceof ContactNotFoundException) {
                return response()->json([
                    'status' => 'CONTACT_NOT_FOUND',
                    'message' => $e->getMessage(),
                    'data' => [$e->getMessage()]
                ], 404);
            }

            if ($e instanceof ContentPathNotFoundException) {
                return response()
                    ->json([
                        'status' => 'CONTENT_IN_PATH_NOT_FOUND',
                        'message' => 'Conteudo não está disponível.',
                    ], 404);
            }
        });
    }
}
