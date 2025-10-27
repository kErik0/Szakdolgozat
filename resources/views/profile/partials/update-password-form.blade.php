<section>
    <header>
        <h2>
            {{ __('Jelszó frissítése') }}
        </h2>

        <p>
            {{ __('Győződj meg róla, hogy a fiókod biztonsága érdekében hosszú, véletlenszerű jelszót használsz.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Jelenlegi jelszó')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Új jelszó')" />
            <x-text-input id="update_password_password" name="password" type="password" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Új jelszó megerősítése')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div>
            <x-primary-button type="submit" name="update_password" value="1">
                {{ __('Mentés') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                >{{ __('Jelszó elmentve.') }}</p>
            @endif
        </div>
    </form>
</section>
