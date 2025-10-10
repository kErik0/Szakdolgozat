<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        Köszönjük, hogy regisztráltál! Mielőtt folytatnád, kérjük, erősítsd meg az email címedet az e-mailben található linkre kattintva. Ha nem kaptad meg az e-mailt, örömmel küldünk egy újat.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            Egy új megerősítő linket elküldtünk a regisztráció során megadott email címre.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ auth('company')->check() ? route('company.verification.send') : route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    Megerősítő email újraküldése
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                Kijelentkezés
            </button>
        </form>
    </div>
</x-guest-layout>
