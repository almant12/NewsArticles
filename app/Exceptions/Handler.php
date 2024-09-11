<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    
    
    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
       
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'message' => 'Resource not found'
            ], 404);
        }

        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }

        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'message' => 'This action is unauthorized.'
            ], 403);
        }

        if ($exception instanceof ValidationException) {
            return response()->json([
                'message' => $exception->errors()
            ], 422);
        }

      
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'message' => 'Not Found'
            ], 404);
        }

       
        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'message' => 'Method Not Allowed'
            ], 405);
        }

        
        if ($exception instanceof HttpException) {
            return response()->json([
                'message' => $exception->getMessage()
            ], $exception->getStatusCode());
        }

        return response()->json([
            'message' =>'Server message'
        ], 500);

    }
}
