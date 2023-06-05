<?php

namespace App\Http\Middleware;

use Closure;

class NullByteFilter
{
    public function handle($request, Closure $next)
    {
        $files = $request->file();
        foreach ($files as $file) {
            if (strpos($file->getClientOriginalName(), "\0") !== false) {
                return response()->json(['error' => 'File contains null byte.'], 400);
            }
        }

        return $next($request);
    }
}
