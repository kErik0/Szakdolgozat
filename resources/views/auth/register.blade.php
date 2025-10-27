<x-app-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="'Név'" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="'Email cím'" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="'Jelszó'" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="'Jelszó megerősítése'" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div>
            <x-input-label :value="__('Regisztráció típusa')" />

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

        <div>
            <a href="{{ route('login') }}">
                Már regisztráltál?
            </a>

            <x-primary-button>
                Regisztráció
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
