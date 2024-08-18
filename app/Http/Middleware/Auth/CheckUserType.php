<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */



    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user->user_type === 'admin' || $user->user_type === 'superadmin') {
            // Allow the request to proceed
            return $next($request);
        }

        // Redirect non-admin users to the home page
        return redirect('/');
    }
}
