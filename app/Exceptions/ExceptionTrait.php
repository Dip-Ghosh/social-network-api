<?php
namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

trait ExceptionTrait
{
    public function apiException($request,$e)
    {
        if ($e instanceof ValidationException) {
            return response()->json($e->validator->getMessageBag()->toArray());
        }

        if ($e instanceof ModelNotFoundException) {

            return response()->json(['errors' => 'Model not found'],Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->json(['errors' => 'Incorrect URL'],Response::HTTP_NOT_FOUND);
        }

        if($e instanceof MethodNotAllowedHttpException){
            return response()->json(['errors' => 'Incorrect HTTP verb'],Response::HTTP_METHOD_NOT_ALLOWED);
        }

        return parent::render($request, $e);

    }


}
