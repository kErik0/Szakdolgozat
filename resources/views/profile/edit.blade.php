<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Profil szerkesztése
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-6 bg-gray-800 p-6 rounded-lg">

            <!-- Profilkép kezelő szekció -->
            <div id="profile-photo" class="bg-gray-900 shadow-sm rounded-lg p-6 max-w-xl">
                <h2 class="text-lg font-semibold text-white mb-4">Profilkép kezelése</h2>

                @if (session('error'))
                    <div class="text-red-500 mb-4">{{ session('error') }}</div>
                @endif

                @if (session('status') == 'profile-picture-updated')
                    <div class="text-green-500 mb-4">A profilkép sikeresen frissítve!</div>
                @endif

                @if (session('status') == 'profile-picture-deleted')
                    <div class="text-green-500 mb-4">A profilkép sikeresen törölve!</div>
                @endif

                @php
                    $profileImage = $user->profile_picture ?? $user->logo;
                @endphp

                @if($profileImage && file_exists(public_path($profileImage)))
                    <div class="mb-4">
                        <img src="{{ asset($profileImage) }}" alt="Profilkép" class="w-16 h-16 rounded-full object-cover shadow-md">
                    </div>
                    <form method="POST" action="{{ route('profile.photo.destroy') }}">
                        @csrf
                        @method('DELETE')
                        <x-primary-button class="bg-red-600 hover:bg-red-700 px-3 py-1.5 rounded-md transition mb-6">
                            Profilkép törlése
                        </x-primary-button>
                    </form>
                @else
                    <div class="mb-4 text-gray-400">Nincs profilkép feltöltve</div>
                @endif

                <form method="POST" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <input type="file" name="profile_picture" accept="image/*" required class="block w-full text-gray-300 bg-gray-700 border border-gray-600 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('profile_picture')
                            <div class="text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <x-primary-button>
                        Új profilkép feltöltése
                    </x-primary-button>
                </form>
            </div>

            <!-- CV kezelő szekció -->
            @auth('web')
            <div id="cv-section" class="bg-gray-900 shadow-sm rounded-lg p-6 max-w-xl">
                <h2 class="text-lg font-semibold text-white mb-4">CV kezelése</h2>

                @if (session('status') == 'cv-updated')
                    <div class="text-green-500 mb-4">A CV sikeresen frissítve!</div>
                @endif

                @if (session('status') == 'cv-deleted')
                    <div class="text-green-500 mb-4">A CV sikeresen törölve!</div>
                @endif

                @php
                    $cvFile = $user->resume;
                @endphp

                @if($cvFile && file_exists(storage_path('app/public/cvs/' . $cvFile)))
                    <div class="mb-4">
                        <a href="{{ asset('storage/cvs/' . $cvFile) }}" target="_blank" class="text-blue-500 hover:underline">
                            Feltöltött CV megtekintése
                        </a>
                    </div>
                    <form method="POST" action="{{ route('profile.cv.destroy') }}">
                        @csrf
                        @method('DELETE')
                        <x-primary-button class="mb-6">
                            CV törlése
                        </x-primary-button>
                    </form>
                @else
                    <div class="mb-4 text-gray-400">Nincs feltöltött CV</div>
                @endif

                <form method="POST" action="{{ route('profile.cv.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <input type="file" name="cv" accept=".pdf,.doc,.docx" required class="block w-full text-gray-300 bg-gray-700 border border-gray-600 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('cv')
                            <div class="text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <x-primary-button>
                        Új CV feltöltése
                    </x-primary-button>
                </form>
            </div>
            @endauth

            <div id="profile-info" class="bg-gray-900 shadow-sm rounded-lg p-6 max-w-xl">
                @include('profile.partials.update-profile-information-form', ['user' => $user])
            </div>

            <div id="password-section" class="bg-gray-900 shadow-sm rounded-lg p-6 max-w-xl">
                @include('profile.partials.update-password-form', ['user' => $user, 'guard' => $user instanceof \App\Models\Company ? 'company' : 'web'])
            </div>

            <div id="account-delete" class="bg-gray-900 shadow-sm rounded-lg p-6 max-w-xl">
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')
                    <div class="mb-4">
                        <label for="password" class="block font-semibold mb-2 text-white">Jelszó megerősítés</label>
                        <input id="password" name="password" type="password" required autocomplete="current-password" class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                        @error('password')
                            <div class="text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <x-primary-button class="bg-red-600 hover:bg-red-700 px-3 py-1.5 rounded-md transition">
                        Fiók törlése
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>