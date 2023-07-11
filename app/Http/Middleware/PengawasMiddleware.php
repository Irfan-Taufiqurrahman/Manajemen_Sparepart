<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class PengawasMiddleware
{
    public function handle($request, Closure $next)
    {
        // if ($request->user() && $request->user()->role !== User::ROLE_PENGAWAS) {
        //     return response('Unauthorized', 401);
        // }

        // return $next($request);
    }
}
