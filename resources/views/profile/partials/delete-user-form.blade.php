<section>
    <header>
        <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">
            Fiók törlése
        </h2>
        <p class="mb-6 text-gray-700 dark:text-gray-300">
            A fiók törlése után minden adat és erőforrás véglegesen törlésre kerül. Mielőtt törölnéd a fiókodat, mentsd le azokat az adatokat, amiket szeretnél megőrizni.
        </p>
    </header>
    <button
        type="button"
        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 w-24 text-sm text-center rounded-md shadow transition"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Fiók törlése</button>
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">
                Biztosan törölni szeretnéd a fiókodat?
            </h2>
            <p class="mb-6 text-gray-700 dark:text-gray-300">
                A fiók törlése után minden adat és erőforrás véglegesen törlésre kerül. Kérjük, írd be a jelszavad a fiók végleges törléséhez.
            </p>
            <div class="mb-6">
                <x-input-label for="password" value="Jelszó" />
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Jelszó"
                    class="w-1/2 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#2f3035] text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition"
                    style="background-clip: padding-box;"
                    autocomplete="off"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" />
            </div>
            <div class="flex gap-4">
                <button
                    type="button"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 w-24 text-sm text-center rounded-md shadow transition"
                    x-on:click="$dispatch('close')"
                >
                    Mégse
                </button>
                <button
                    type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 w-24 text-sm text-center rounded-md shadow transition"
                >
                    Fiók törlése
                </button>
            </div>
        </form>
    </x-modal>
</section>
