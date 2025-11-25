
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
            class="max-w-4xl mx-auto mt-6 bg-red-100 border-red-400 text-red-800 px-6 py-3 rounded-lg text-center shadow"
        >
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <div class="flex justify-center items-center min-h-[80vh]">
        <form method="POST" action="{{ route('password.confirm') }}" class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 p-8 rounded-xl shadow-sm w-full max-w-md space-y-6">
            @csrf

            <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-gray-100 mb-6 tracking-wide">Jelszó megerősítése</h2>

            <p class="text-sm text-gray-600 dark:text-gray-400 text-center">
                Ez az alkalmazás biztonságos területe. Kérjük, erősítsd meg a jelszavad a folytatás előtt.
            </p>
            <div>
                <label for="password" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Jelszó</label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                    class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#2f3035] text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus-visible:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-0 focus:border-gray-500 transition" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="flex justify-center mt-4">
                <button type="submit" class="bg-[#1f1f1f] dark:bg-gray-800 hover:bg-gray-900 dark:hover:bg-gray-700 text-white px-6 py-2 rounded-lg w-40 shadow transition">
                    Megerősítés
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
