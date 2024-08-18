<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if ($request->ajax()) {
                return response()->json(['message' => 'You need to log in first.'], 401);
            }

            return redirect('/login')->with('error', 'You should log in first.');
        }

        return $next($request);
    }
}
