<?php

namespace App\Http\Middleware;

use Closure;

class AdminPastoralAndCellGroupLeaderOnly
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
        if (\Auth::guest()) {
            \Auth::authenticate();
        }
        if (!\Auth::user()->hasRole('root_admin')&&!\Auth::user()->hasRole('cgl')&&!\Auth::user()->hasRole('pastoral')) {
            abort(403, 'Unauthorized access.');
        }
        return $next($request);
    }
}
