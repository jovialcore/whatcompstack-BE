<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MarketerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (is_null(Auth::user()->role)  && Auth::user()->role !== 'marketer') {
            return response()->json([
                'message' => 'You are not a marketer',

            ], 403);
        }
        return $next($request);
    }
}
