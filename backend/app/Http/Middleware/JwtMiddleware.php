<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = $request->header('Authorization');

        dd($auth);

        return $next($request);
    }
}
