<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role !== User::ROLE_ADMIN) {
            return response('Unauthorized', 401);
        }

        return $next($request);
    }
}
