<section>
    <header>
        <p class="text-gray-700 dark:text-gray-300 mb-4">
            {{ __('Győződj meg róla, hogy a fiókod biztonsága érdekében hosszú, véletlenszerű jelszót használsz.') }}
        </p>
    </header>
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('patch')
        <div class="space-y-4">
            <div>
                <x-input-label for="update_password_current_password" :value="__('Jelenlegi jelszó')" class="block mb-1 text-gray-700 dark:text-gray-300" />
                <input id="update_password_current_password" name="current_password" type="password" autocomplete="off" style="background-clip: padding-box;" class="w-1/2 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#2f3035] text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1 text-sm text-red-600 dark:text-red-400" />
            </div>
            <div>
                <x-input-label for="update_password_password" :value="__('Új jelszó')" class="block mb-1 text-gray-700 dark:text-gray-300" />
                <input id="update_password_password" name="password" type="password" autocomplete="off" style="background-clip: padding-box;" class="w-1/2 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#2f3035] text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1 text-sm text-red-600 dark:text-red-400" />
                <ul class="mt-2 text-sm text-gray-600 dark:text-gray-400 space-y-1">
                    <li>• Minimum 8 karakter</li>
                    <li>• Legalább egy kisbetű</li>
                    <li>• Legalább egy nagybetű</li>
                </ul>
            </div>
            <div>
                <x-input-label for="update_password_password_confirmation" :value="__('Új jelszó megerősítése')" class="block mb-1 text-gray-700 dark:text-gray-300" />
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="off" style="background-clip: padding-box;" class="w-1/2 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#2f3035] text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1 text-sm text-red-600 dark:text-red-400" />
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" name="update_password" value="1" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 w-24 text-sm text-center rounded-md shadow transition">
                {{ __('Mentés') }}
            </button>
        </div>
    </form>
</section>
