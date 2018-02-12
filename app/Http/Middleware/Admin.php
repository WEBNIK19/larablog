<?php

namespace App\Http\Middleware;

use Closure;
use App\Classes\Constants;
use Illuminate\Routing\Redirector;
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
            return redirect('home');
        }

        return $next($request);
    }
}
