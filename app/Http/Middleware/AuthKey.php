<?php

namespace App\Http\Middleware;

use Closure;

class AuthKey
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
        /*$token = $request->header('APP_KEY');
        if ($token != 'tes') {
            return response()->json(['message'=>'App Key Not Found'], 400);
        }*/
        return $next($request);
    }
}
