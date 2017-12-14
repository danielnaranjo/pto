<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // https://laracasts.com/discuss/channels/laravel/session-timeout-and-forwarding-back-to-login-page
        if ( $exception instanceof \Illuminate\Session\TokenMismatchException ) {
            //return redirect('/')->action('HomeController@index')->with('error', 'Ha ocurrido un error, por favor, verifica los datos de acceso');//TODO
            // \Log::warning('TokenMismatchException: '.$exception); //rollbar
            return redirect('/');
        }
        //
        // https://laracasts.com/discuss/channels/requests/how-can-i-redirect-all-request-of-notfoundhttpexception-to-the-home-page
        if ($exception instanceof ModelNotFoundException) {
            // \Log::notice('QueryException: '.$exception);
            $exception = new NotFoundHttpException($exception->getMessage(), $exception);
        }
        if ($exception instanceof NotFoundHttpException) {
            // \Log::notice('QueryException: '.$exception);
            return redirect('/');
        }

        if ($exception instanceof QueryException) {
            // \Log::critical('QueryException: '.$exception);
            return redirect('/');
        }
        if ($exception instanceof MethodNotAllowedHttpException) {
            // \Log::notice('QueryException: '.$exception);
            return redirect('/');
        }return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
