<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('isLoggedIn')) {
            return redirect()->route('admin_default_page')->with('error', 'You must be logged in to access Admin page.');
        }

        return $next($request);
    }
}
