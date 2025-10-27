<x-app-layout>
    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email cím')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Jelszó')" />

            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div>
            <x-input-label :value="__('Bejelentkezés típusa')" />
            <label>
                <input type="radio" name="role" value="user" {{ old('role', 'user') == 'user' ? 'checked' : '' }}>
                Felhasználó
            </label>
            <label>
                <input type="radio" name="role" value="company" {{ old('role') == 'company' ? 'checked' : '' }}>
                Cég
            </label>
            <x-input-error :messages="$errors->get('role')" />
        </div>

        <!-- Remember Me -->
        <div>
            <label for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                {{ __('Emlékezz rám') }}
            </label>
        </div>

        <div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('Elfelejtetted a jelszavad?') }}
                </a>
            @endif

            <x-primary-button>
                {{ __('Bejelentkezés') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
