<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::guard('web')->user() ?? Auth::guard('company')->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->role !== $role) {
            return redirect()->route('dashboard')->with('error', 'Nincs jogosultságod az oldal megtekintéséhez.');
        }

        return $next($request);
    }
}