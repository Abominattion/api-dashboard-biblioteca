<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\UnauthorizedException as ValidationUnauthorizedException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request .
     * @param \Exception               $e       .
     * @return mixed \Illuminate\Http\Response or \Illuminate\Http\JsonResponse
     */
    public function render($request = null, Throwable $e)
    {

        if ($e instanceof AuthenticationException) {
            return response()->json(['Não autorizado'], 401);
        }
        if ($e instanceof TokenExpiredException) {
            return response()->json(['token_expired'], 401);
        } elseif ($e instanceof TokenInvalidException) {
            return response()->json(['token_invalid'], 401);
        }
        if ($e instanceof ValidationException) {
            return response()->json(['message' => 'Os dados fornecidos não são válidos.', 'errors' => $e->validator->getMessageBag()], 422);
        }
        if ($e instanceof ModelNotFoundException) {
            return response()->json(['message' => 'Recurso não econtrado!'], 404);
        }
        if ($e instanceof ValidationUnauthorizedException) {
            return response()->json(['message' => 'Não autorizado!'], 403);
        }
        if(App::environment('production')){
            return response()->json([
                'message' => 'Erro inesperado no servidor.'
            ],500);
        }

        return parent::render($request, $e);
    }
}
