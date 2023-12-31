<?php

namespace App\Exceptions;

use App\Http\Traits\ApiDesignTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiDesignTrait;
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

    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidationException) {
            return $this->ApiResponse(400, "Validation Errors", $e->errors());
        }elseif ($e instanceof NotFoundHttpException){
            return $this->ApiResponse(400, "Validation Errors", $request->url(), 'Not Found, try with correct url');
        }elseif ($e instanceof AuthorizationException || $e instanceof AccessDeniedHttpException){
            return $this->ApiResponse(400, "unauthorized");
        }elseif ($e instanceof AuthenticationException){
            return $this->ApiResponse(400, "unauthenticated");
        }
        else{
            return $this->ApiResponse(400, "Errors", $e->getMessage());
        }
    }
}
