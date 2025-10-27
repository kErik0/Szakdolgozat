<section>
    <header>
        <h2>
            {{ __('Profilinformációk') }}
        </h2>

        <p>
            {{ __("Frissítsd a fiókod profilinformációit és az email címedet.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Név')" />
            <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email cím')" />
            <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p>
                        {{ __('Az email címed nincs még megerősítve.') }}

                        <button form="send-verification">
                            {{ __('Kattints ide az ellenőrző email újraküldéséhez.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p>
                            {{ __('Egy új ellenőrző linket küldtünk az email címedre.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @if($user instanceof \App\Models\Company)
            <div>
                <x-input-label for="address" value="Cím" />
                <x-text-input id="address" name="address" type="text" value="{{ old('address', $user->address) }}" minlength="5" maxlength="255" />
                <x-input-error :messages="$errors->userUpdate->get('address')" />
            </div>

            <div>
                <x-input-label for="tax_number" value="Adószám" />
                <x-text-input id="tax_number" name="tax_number" type="text" value="{{ old('tax_number', $user->tax_number) }}" minlength="8" maxlength="50" />
                <x-input-error :messages="$errors->userUpdate->get('tax_number')" />
            </div>

            <div>
                <x-input-label for="phone" value="Telefonszám" />
                <x-text-input id="phone" name="phone" type="tel" pattern="^\+?[0-9]+$" value="{{ old('phone', $user->phone) }}" minlength="8" maxlength="15" />
                <x-input-error :messages="$errors->userUpdate->get('phone')" />
            </div>
        @endif

        <div>
            <x-primary-button>
                {{ __('Mentés') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                >{{ __('Mentve.') }}</p>
            @endif
        </div>
    </form>
</section>
