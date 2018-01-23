<?php

namespace App\Http\Middleware;

use Closure;
use App\Classes\Constants;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   

        if(Auth::user()->type_user_id != Constants::USER_TYPE_ADMIN){

            throw new AccessDeniedHttpException('Not anough rights');
        }

        return $next($request);
    }
}
