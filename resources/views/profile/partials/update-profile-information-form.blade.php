<section>
        <header>
            <p class="mb-6 text-gray-700 dark:text-gray-300">
                {{ __("Frissítsd a fiókod profilinformációit és az email címedet.") }}
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="space-y-4">
                <div>
                    <label for="name" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Név</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="off" style="background-clip: padding-box;"
                        class="w-1/2 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#2f3035] text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus-visible:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-0 focus:border-gray-500 transition" />
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div>
                    <label for="email" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Email cím</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="off" style="background-clip: padding-box;"
                        class="w-1/2 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#2f3035] text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus-visible:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-0 focus:border-gray-500 transition" />
                    <x-input-error :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-4 p-4 rounded-md border border-yellow-400 bg-yellow-50 dark:bg-[#3a3a2a] dark:border-yellow-600">
                            <p class="text-yellow-800 dark:text-yellow-300 font-medium mb-2">
                                ⚠️ Az email címed még nincs megerősítve.
                            </p>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mb-3">
                                Kérjük, ellenőrizd a beérkező leveleid között az aktiváló linket, vagy kattints az alábbi gombra új ellenőrző email küldéséhez.
                            </p>
                            <button form="send-verification"
                                class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium shadow transition">
                                Ellenőrző email újraküldése
                            </button>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-3 text-green-700 dark:text-green-400 text-sm font-medium">
                                    ✅ Egy új ellenőrző linket küldtünk az email címedre.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                @if($user instanceof \App\Models\Company)
                    <div>
                        <label for="address" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Cím</label>
                        <input id="address" name="address" type="text" value="{{ old('address', $user->address) }}" minlength="5" maxlength="255" autocomplete="off" style="background-clip: padding-box;"
                            class="w-1/2 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#2f3035] text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus-visible:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-0 focus:border-gray-500 transition" />
                        <x-input-error :messages="$errors->userUpdate->get('address')" />
                    </div>

                    <div>
                        <label for="tax_number" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Adószám</label>
                        <input id="tax_number" name="tax_number" type="text" value="{{ old('tax_number', $user->tax_number) }}" minlength="8" maxlength="50" autocomplete="off" style="background-clip: padding-box;"
                            class="w-1/2 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#2f3035] text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus-visible:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-0 focus:border-gray-500 transition" />
                        <x-input-error :messages="$errors->userUpdate->get('tax_number')" />
                    </div>

                    <div>
                        <label for="phone" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Telefonszám</label>
                        <input id="phone" name="phone" type="tel" pattern="^\+?[0-9]+$" value="{{ old('phone', $user->phone) }}" minlength="8" maxlength="15" autocomplete="off" style="background-clip: padding-box;"
                            class="w-1/2 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#2f3035] text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus-visible:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-0 focus:border-gray-500 transition" />
                        <x-input-error :messages="$errors->userUpdate->get('phone')" />
                    </div>
                @endif

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 w-24 text-sm text-center rounded-md shadow transition">
                        Mentés
                    </button>
                </div>
            </div>
        </form>
    </section>
