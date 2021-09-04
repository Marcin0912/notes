<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateOnceWithBasicAuth
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
        if(!$request->header('Authorization')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        if (Auth::onceBasic()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        } else {
            return $next($request);
        }
    }
}
