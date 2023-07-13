<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class PelaksanaMiddleware
{
    public function handle($request, Closure $next)
    {

        if ($request->user() && strtolower($request->user()->role->name) !== User::ROLE_PELAKSANA) {
            return response('Unauthorized', 401);
        }

        return $next($request);
    }
}
