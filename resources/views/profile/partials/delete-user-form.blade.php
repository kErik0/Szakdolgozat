<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Fiók törlése
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            A fiók törlése után minden adat és erőforrás véglegesen törlésre kerül. Mielőtt törölnéd a fiókodat, mentsd le azokat az adatokat, amiket szeretnél megőrizni.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Fiók törlése</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Biztosan törölni szeretnéd a fiókodat?
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                A fiók törlése után minden adat és erőforrás véglegesen törlésre kerül. Kérjük, írd be a jelszavad a fiók végleges törléséhez.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Jelszó" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Jelszó"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Mégse
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Fiók törlése
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
