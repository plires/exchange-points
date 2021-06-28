<?php

namespace App\Http\Middleware;

use Closure;

class CheckUsersRole
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

        if (auth()->user()) {

            if (auth()->user()->role_id === 1) {
                return $next($request);
            }
        }

        return redirect('/login');
    }
}
