<section>
    <header>
        <h2>
            Fiók törlése
        </h2>

        <p>
            A fiók törlése után minden adat és erőforrás véglegesen törlésre kerül. Mielőtt törölnéd a fiókodat, mentsd le azokat az adatokat, amiket szeretnél megőrizni.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Fiók törlése</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <h2>
                Biztosan törölni szeretnéd a fiókodat?
            </h2>

            <p>
                A fiók törlése után minden adat és erőforrás véglegesen törlésre kerül. Kérjük, írd be a jelszavad a fiók végleges törléséhez.
            </p>

            <div>
                <x-input-label for="password" value="Jelszó" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Jelszó"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" />
            </div>

            <div>
                <x-secondary-button x-on:click="$dispatch('close')">
                    Mégse
                </x-secondary-button>

                <x-danger-button>
                    Fiók törlése
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
