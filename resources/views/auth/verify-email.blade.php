<x-app-layout>
    @if (session('status') == 'verification-link-sent')
        <div 
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 3000)"
            class="max-w-4xl mx-auto mt-6 bg-green-100 border border-green-400 text-green-800 px-6 py-3 rounded-lg text-center shadow"
        >
            ✅ Egy új megerősítő linket elküldtünk a regisztráció során megadott email címre.
        </div>
    @endif

    <div class="flex justify-center items-center min-h-[80vh]">
        <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 p-8 rounded-xl shadow-sm w-full max-w-md space-y-6 text-center">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4 tracking-wide">Email megerősítése</h2>

            <p class="text-sm text-gray-700 dark:text-gray-300 mb-6">
                Köszönjük, hogy regisztráltál! Mielőtt folytatnád, kérjük, erősítsd meg az email címedet az e-mailben található linkre kattintva.<br>
                Ha nem kaptad meg az emailt, kattints az alábbi gombra új link kéréséhez.
            </p>

            <form method="POST" action="{{ auth('company')->check() ? route('company.verification.send') : route('verification.send') }}" class="space-y-4">
                @csrf
                <button type="submit" class="bg-[#1f1f1f] dark:bg-gray-800 hover:bg-gray-900 dark:hover:bg-gray-700 text-white px-4 py-1.5 rounded-lg w-48 shadow transition">
                    Email újraküldése
                </button>
            </form>

            <form method="POST" action="{{ auth('company')->check() ? route('company.logout') : route('logout') }}" class="mt-4">
                @csrf
                <button type="submit"
                    class="bg-[#1f1f1f] dark:bg-gray-800 hover:bg-gray-900 dark:hover:bg-gray-700 text-white px-4 py-1.5 rounded-lg w-48 shadow transition">
                    Kijelentkezés
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
