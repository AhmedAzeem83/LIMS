<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                // Redirect based on user role
                if ($user->hasRole('Admin')) {
                    return redirect()->route('dashboard');
                } elseif ($user->hasRole('Lab Manager')) {
                    return redirect('/home'); // Or a custom route for Lab Manager
                } elseif ($user->hasRole('Chemist Supervisor')) {
                    return redirect('/home'); // Or a custom route for Chemist Supervisor
                } elseif ($user->hasRole('Lab Technician')) {
                    return redirect('/home'); // Or a custom route for Lab Technician
                } else {
                    return redirect(RouteServiceProvider::HOME);
                }
            }
        }

        return $next($request);
    }
}
