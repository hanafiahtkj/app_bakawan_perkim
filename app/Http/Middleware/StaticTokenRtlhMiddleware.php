<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaticTokenRtlhMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $staticToken = 'AIzaSyXqGwSgXQbdG-Nf3eHPl7zX5rkXhxVdL8o';

        $token = $request->bearerToken();

        if ($token !== $staticToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
