<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->system_admin == "1") {
                return $next($request);
            }

            $user_power = get_user_power(auth()->user()->id);
            if (isset($user_power['school_admin'])) {
                if ($user_power['school_admin'] == "1") {
                    return $next($request);
                }                
            }
            if (isset($user_power['lunch_admin'])) {
                if ($user_power['lunch_admin'] == "1") {
                    return $next($request);
                }                
            }
            if (isset($user_power['club_admin'])) {
                if ($user_power['club_admin'] == "1") {
                    return $next($request);
                }                
            }
        }
        return redirect()->route('index');
    }
}
