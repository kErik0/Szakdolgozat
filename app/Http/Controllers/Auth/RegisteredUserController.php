<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $role = $request->input('role');

        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . ($role === 'company' ? Company::class : User::class)],
                'phone' => ['required', 'string', 'max:20', 'regex:/^\+?[0-9]{8,15}$/'],
                'password' => [
                    'required',
                    'confirmed',
                    Rules\Password::min(8)->mixedCase(),
                ],
                'role' => ['required', 'string', 'in:user,company'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();

            // Move confirmation mismatch to password_confirmation
            if ($errors->has('password') && str_contains($errors->first('password'), 'egyezik')) {
                $errors->add('password_confirmation', $errors->first('password'));
                $errors->forget('password');
            }

            throw $e;
        }

        if ($role === 'company') {
            $company = Company::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($company));

            Auth::guard('company')->login($company);

            return redirect(route('jobs.browse', absolute: false))
                ->with('success', 'Sikeresen regisztráltál!');
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => $role,
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(route('jobs.browse', absolute: false))
                ->with('success', 'Sikeresen regisztráltál!');
        }
    }
}
