<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class PengawasMiddleware
{
    public function handle($request, Closure $next)
    {

        // if ($request->user() && $request->user()->role->name === 'pengawas') {
        //     return $next($request);
        // }
        if ($request->user() && strtolower($request->user()->role->name) !== User::ROLE_PENGAWAS) {
            return redirect()->route('auth.error');
        }

        return $next($request);
    }
}
