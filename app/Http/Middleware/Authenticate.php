<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Redirect unauthenticated users to login, but you can customize this
        // For example, redirect to a custom guest landing page if needed
        return $request->expectsJson() ? null : route('login');
    }
}
