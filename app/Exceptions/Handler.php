<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Exceptions\ExceptionTrait;
use Exception;
class Handler extends ExceptionHandler
{
    use ExceptionTrait;
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
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
        if ($request->expectsJson()) {
            return $this->apiException($request,$e);
        }
        return parent::render($request, $e);
    }
}
