<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $role = $request->input('role');

        if ($role === 'company') {
            $loginSuccess = Auth::guard('company')->attempt($request->only('email', 'password'), $request->filled('remember'));

            if (!$loginSuccess) {
                return back()->withErrors([
                    'email' => 'Hibás e-mail cím vagy jelszó.',
                ]);
            }

            $user = Auth::guard('company')->user();
            if (!$user->hasVerifiedEmail()) {
                Auth::guard('company')->logout();
                return redirect()->route('verification.notice');
            }

            $request->session()->regenerate();
            return redirect()->route('jobs.browse');
        } else {
            if (Auth::guard('web')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
                $user = Auth::guard('web')->user();
                if (!$user->hasVerifiedEmail()) {
                    Auth::guard('web')->logout();
                    return redirect()->route('verification.notice');
                }

                $request->session()->regenerate();

                return redirect()->route('jobs.browse');
            } else {
                return back()->withErrors([
                    'email' => 'Hibás e-mail cím vagy jelszó.',
                ]);
            }
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
    // Először ellenőrizd, melyik guard van bejelentkezve
        if (Auth::guard('company')->check()) {
            Auth::guard('company')->logout();
        }

        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

    // Session érvénytelenítés és token újragenerálás
        $request->session()->invalidate();
        $request->session()->regenerateToken();

    // Irány a login oldal, hogy ne töltse vissza automatikusan a régi sessiont
        return redirect('/')->withHeaders([
        'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
        'Pragma' => 'no-cache',
        'Expires' => 'Fri, 01 Jan 1990 00:00:00 GMT'

    ]);
    }
}
