<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;

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
        $this->renderable(function (ContactNotFoundException $e, Request $request) {
            return response()->json([
                'status' => 'CONTACT_NOT_FOUND',
                'message' => $e->getMessage(),
                'data' => [ $e->getMessage() ]
            ],404);
        });
    }
}
