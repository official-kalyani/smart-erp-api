<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        \Log::info('🔐 RoleMiddleware Check', [
        'user' => Auth::check() ? Auth::user()->toArray() : 'guest',
        'required_roles' => $roles
    ]);

    if (!Auth::check()) {
        abort(403, 'Unauthorized');
    }

    if (!in_array(Auth::user()->role, $roles)) {
        abort(403, 'You do not have permission to access this resource.');
    }

    return $next($request);
    }
}
