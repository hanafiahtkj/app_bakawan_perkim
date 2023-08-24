<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaticTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $staticToken = 'AIzaSyCGpcum7xga8slj5q_taQfNVuFn3KbLAV0';

        $token = $request->bearerToken();

        if ($token !== $staticToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
