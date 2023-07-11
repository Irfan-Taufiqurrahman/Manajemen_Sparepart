<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class PelaksanaMiddleware
{
    public function handle($request, Closure $next)
    {
        // dd($request->user()->role);
        if ($request->user() && $request->user()->role !== 'pengawas') {
            return response('Unauthorized', 401);
        }

        return $next($request);
    }
}
