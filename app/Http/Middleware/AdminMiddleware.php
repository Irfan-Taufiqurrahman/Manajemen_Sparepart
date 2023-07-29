<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && strtolower($request->user()->role->name) !== User::ROLE_ADMIN) {
            return redirect()->route('auth.errors');
        }

        return $next($request);
    }
}
