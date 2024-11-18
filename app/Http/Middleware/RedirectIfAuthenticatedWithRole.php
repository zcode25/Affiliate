<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticatedWithRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            // Periksa role user dan arahkan ke dashboard yang sesuai
            if ($role == 'Admin') {
                return redirect()->route('dashboardAdmin');
            }

            if ($role == 'Affiliate') {
                return redirect()->route('dashboard');
            }
        }
        
        return $next($request);
    }
}
