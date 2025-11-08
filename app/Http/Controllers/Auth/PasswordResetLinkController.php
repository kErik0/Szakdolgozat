<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Company;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = $request->email;

        if (User::where('email', $email)->exists()) {
            $status = Password::broker('users')->sendResetLink(['email' => $email]);
        } elseif (Company::where('email', $email)->exists()) {
            $status = Password::broker('companies')->sendResetLink(['email' => $email]);
        } else {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'Nincs ilyen felhasználói vagy céges fiók.']);
        }

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
