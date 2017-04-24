<?php

namespace App\Http\Middleware;

use Closure;

class HashTokenRequired
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
        $uuid = trim(request()->header('UUID'), '"');
        $myHash = md5( env('HASH_KEY') . substr($uuid, 2, 6) );
        $requestHash = trim(request()->header('Hash'), '"');

        if ($requestHash !== $myHash) {
            die(':)');
        }

        return $next($request);
    }
}
