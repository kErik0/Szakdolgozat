<x-app-layout>
    @if (session('success'))
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-transition 
            x-init="setTimeout(() => show = false, 3000)" 
            class="max-w-4xl mx-auto mt-6 bg-green-100 border border-green-400 text-green-800 px-6 py-3 rounded-lg text-center shadow"
        >
            ✅ {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-transition 
            x-init="setTimeout(() => show = false, 3000)" 
            class="max-w-4xl mx-auto mt-6 bg-red-100 border border-red-400 text-red-800 px-6 py-3 rounded-lg text-center shadow"
        >
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <div class="flex justify-center items-center min-h-[80vh]">
        <form method="POST" action="{{ route('login') }}" class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 p-8 rounded-xl shadow-sm w-full max-w-md space-y-6">
            @csrf

            <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-gray-100 mb-6 tracking-wide">Bejelentkezés</h2>

            <div>
                <label for="email" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Email cím</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#2f3035] text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus-visible:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-0 focus:border-gray-500 transition" />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <div>
                <label for="password" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Jelszó</label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                    class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#2f3035] text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus-visible:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-0 focus:border-gray-500 transition" />
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <div class="text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-[#3a3a3a] p-3 rounded-md border border-gray-300 dark:border-gray-600 mt-3">
                <span class="block text-sm mb-2 font-medium">Bejelentkezés típusa</span>
                <div class="flex justify-center gap-6">
                    <label class="flex items-center gap-1 cursor-pointer">
                        <input type="radio" name="role" value="user" {{ old('role', 'user') == 'user' ? 'checked' : '' }}
                            class="appearance-none w-4 h-4 border border-gray-500 dark:border-gray-400 rounded-full bg-white dark:bg-[#2f3035] checked:bg-gray-500 checked:dark:bg-gray-400 focus:ring-0 focus:ring-offset-0 focus:outline-none focus-visible:outline-none transition">
                        Felhasználó
                    </label>
                    <label class="flex items-center gap-1 cursor-pointer">
                        <input type="radio" name="role" value="company" {{ old('role') == 'company' ? 'checked' : '' }}
                            class="appearance-none w-4 h-4 border border-gray-500 dark:border-gray-400 rounded-full bg-white dark:bg-[#2f3035] checked:bg-gray-500 checked:dark:bg-gray-400 focus:ring-0 focus:ring-offset-0 focus:outline-none focus-visible:outline-none transition">
                        Cég
                    </label>
                </div>
                <x-input-error :messages="$errors->get('role')" />
            </div>

            <div class="flex items-center justify-start gap-2 text-gray-700 dark:text-gray-300 mt-2">
                <input id="remember_me" type="checkbox" name="remember"
                    class="appearance-none w-4 h-4 border border-gray-500 dark:border-gray-400 rounded-sm bg-white dark:bg-[#2f3035] checked:bg-gray-500 checked:dark:bg-gray-400 focus:ring-0 focus:ring-offset-0 focus:outline-none focus-visible:outline-none transition">
                <label for="remember_me">{{ __('Emlékezz rám') }}</label>
            </div>

            <div class="flex flex-col items-center space-y-3 mt-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:underline">
                        {{ __('Elfelejtetted a jelszavad?') }}
                    </a>
                @endif

                <button type="submit" class="bg-[#1f1f1f] dark:bg-gray-800 hover:bg-gray-900 dark:hover:bg-gray-700 text-white px-6 py-2 rounded-lg w-36 shadow transition">
                    Bejelentkezés
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
