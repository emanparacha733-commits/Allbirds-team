<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Check if admin is logged in using session
        if (!$request->session()->has('admin_logged_in')) {
            // Redirect to admin login if not logged in
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}