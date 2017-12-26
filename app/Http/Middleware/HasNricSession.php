<?php

namespace App\Http\Middleware;

use Closure;

class HasNricSession
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
        if (!session('nric')) {
            return redirect('event/bible_reading/nric');
        }
        
        return $next($request);
    }
}
