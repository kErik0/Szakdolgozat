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
                    'email' => 'Company login failed. Please check credentials.',
                ]);
            }

            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } else {
            if (Auth::guard('web')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
                $request->session()->regenerate();

                return redirect()->route('dashboard');
            } else {
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ]);
            }
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $role = $request->input('role');

        if ($role === 'company') {
            Auth::guard('company')->logout();
        } else {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
