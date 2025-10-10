<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email cím')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Jelszó')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

<div class="mt-4">
                <x-input-label :value="__('Bejelentkezés típusa')" />
                <div class="flex justify-center items-center mt-2 space-x-8">
                    <label class="inline-flex items-center">
                        <input type="radio" name="role" value="user" {{ old('role', 'user') == 'user' ? 'checked' : '' }} class="form-radio">
                        <span class="ml-2 text-white">Felhasználó</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="role" value="company" {{ old('role') == 'company' ? 'checked' : '' }} class="form-radio">
                        <span class="ml-2 text-white">Cég</span>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>        
            <!-- Remember Me -->
            <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Emlékezz rám') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Elfelejtetted a jelszavad?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Bejelentkezés') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
