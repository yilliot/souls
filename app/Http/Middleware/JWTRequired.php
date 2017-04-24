<?php

namespace App\Http\Middleware;

use Closure;

class JWTRequired
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
        try {

            \JWTAuth::parseToken()->authenticate();

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            throw $e;
            
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            die(':(');
        }

        return $next($request);
    }
}
