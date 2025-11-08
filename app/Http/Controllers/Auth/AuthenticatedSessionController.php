<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Company;

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
            // Email létezés ellenőrzése (company)
            $companyExists = Company::where('email', $request->email)->exists();

            if (! $companyExists) {
                return back()->withErrors([
                    'email' => 'Még nincs ilyen céges fiók.',
                ])->withInput();
            }

            // Jelszó ellenőrzése
            $loginSuccess = Auth::guard('company')->attempt(
                $request->only('email', 'password'),
                $request->filled('remember')
            );

            if (! $loginSuccess) {
                return back()->withErrors([
                    'password' => 'Hibás jelszó.',
                ])->withInput();
            }

            $request->session()->regenerate();
            return redirect()->route('jobs.browse');

        } else {
            // Email létezés ellenőrzése (user)
            $userExists = User::where('email', $request->email)->exists();

            if (! $userExists) {
                return back()->withErrors([
                    'email' => 'Még nincs ilyen felhasználói fiók.',
                ])->withInput();
            }

            // Jelszó ellenőrzése
            $loginSuccess = Auth::guard('web')->attempt(
                $request->only('email', 'password'),
                $request->filled('remember')
            );

            if (! $loginSuccess) {
                return back()->withErrors([
                    'password' => 'Hibás jelszó.',
                ])->withInput();
            }

            $request->session()->regenerate();
            return redirect()->route('jobs.browse');
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
