<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        if ($request->key === env('API_KEY')) {
            return $next($request);
        }

        throw new HttpResponseException(
            response()->json(['error' => 'Token invalid or empty'], 403)
        );
    }
}
