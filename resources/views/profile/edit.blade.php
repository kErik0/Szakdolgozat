<x-app-layout>
    @if (session('success'))
        <div class="max-w-4xl mx-auto mt-6 bg-green-100 border border-green-400 text-green-800 px-6 py-3 rounded-lg text-center shadow" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition>
            ✅ {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-4xl mx-auto mt-6 bg-red-100 border border-red-400 text-red-800 px-6 py-3 rounded-lg text-center shadow" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition>
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 mt-10 px-8 lg:px-12">

        <!-- BAL OLDAL -->
        <div class="space-y-8">
            <!-- Profilkép blokk -->
            <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 p-6 rounded-xl shadow-sm transition-transform transform hover:scale-105 hover:shadow-lg duration-300">
                <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Profilkép</h2>

                <form method="POST" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data" class="flex flex-col items-center gap-4">
                    @csrf
                    <div id="dropzone" class="relative w-40 h-40 mx-auto border-2 border-dashed border-gray-400 dark:border-gray-600 rounded-full flex items-center justify-center hover:border-gray-500 dark:hover:border-gray-400 transition overflow-hidden">
                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <img id="preview"
                             src="{{ 
                                 ($user instanceof \App\Models\Company && $user->logo && file_exists(public_path($user->logo))) 
                                     ? asset($user->logo) 
                                     : (($user->profile_picture && file_exists(public_path($user->profile_picture))) 
                                         ? asset($user->profile_picture) 
                                         : '') 
                             }}"
                             class="w-40 h-40 rounded-full object-cover border border-gray-300 dark:border-gray-700 {{ ($user instanceof \App\Models\Company && $user->logo) || $user->profile_picture ? '' : 'hidden' }}">
                        <span id="upload-text" class="{{ ($user instanceof \App\Models\Company && $user->logo) || $user->profile_picture ? 'hidden' : '' }} text-gray-500 dark:text-gray-300 absolute inset-0 flex items-center justify-center text-center">
                            Kattints a kép kiválasztásához
                        </span>
                    </div>

                    <div class="flex justify-center gap-3 mt-3">
                        <form method="POST" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data" class="inline">
                            @csrf
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-1.5 w-24 text-sm text-center rounded-md shadow transition">Mentés</button>
                        </form>
                        <form method="POST" action="{{ route('profile.photo.destroy') }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1.5 w-24 text-sm text-center rounded-md shadow transition">Törlés</button>
                        </form>
                    </div>
                </form>

            </div>

            @if($user instanceof \App\Models\Company)
                <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 p-6 rounded-xl shadow-sm transition-transform transform hover:scale-105 hover:shadow-lg duration-300">
                    <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Cég leírása</h2>
                    <form method="POST" action="{{ route('company.updateDescription') }}">
                        @csrf
                        @method('PATCH')
                        <textarea name="description" rows="5" class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 
                            text-gray-800 dark:text-gray-100 placeholder-gray-500 
                            dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition">{{ old('description', $user->description) }}</textarea>
                        <label for="website" class="block mb-2 text-gray-700 dark:text-gray-300 font-medium">Cég weboldala</label>
                        <input type="url" name="website" id="website" value="{{ old('website', $user->website) }}" 
                               class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 
                                      bg-white dark:bg-[#2f3035] text-gray-800 dark:text-gray-100 
                                      placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none 
                                      focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition"
                               placeholder="https://peldaoldal.hu">
                        <div class="flex justify-center mt-4">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-1.5 w-24 text-sm text-center rounded-md shadow transition">
                                Mentés
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 p-6 rounded-xl shadow-sm transition-transform transform hover:scale-105 hover:shadow-lg duration-300">
                    <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">CV kezelése</h2>

                    @php $cvFile = $user->resume; @endphp

                    @if($cvFile && file_exists(storage_path('app/public/cvs/' . $cvFile)))
                        <div class="flex justify-center gap-4 mb-5">
                            <a href="{{ asset('storage/cvs/' . $cvFile) }}" target="_blank"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 w-32 text-sm text-center rounded-md shadow transition">
                            Megtekintés
                            </a>
                            <form method="POST" action="{{ route('profile.cv.destroy') }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 w-32 text-sm text-center rounded-md shadow transition">
                                    Törlés
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="text-gray-700 dark:text-gray-300 mb-5">Nincs feltöltött CV</div>
                    @endif

                    <form method="POST" action="{{ route('profile.cv.update') }}" enctype="multipart/form-data" class="flex flex-col items-center gap-3">
                        @csrf
                        <div class="flex justify-center gap-4">
                            <label for="cv" class="bg-gray-900 dark:bg-gray-100 dark:text-gray-900 text-white px-5 py-2 w-32 text-sm rounded-md cursor-pointer hover:bg-gray-700 dark:hover:bg-gray-300 transition text-center">
                                CV kiválasztása
                                <input type="file" name="cv" id="cv" accept=".pdf,.doc,.docx" required class="hidden" onchange="document.getElementById('selectedCvFile').innerText = 'Kiválasztott fájl: ' + this.files[0].name">
                            </label>
                        </div>
                        <p id="selectedCvFile" class="text-green-600 dark:text-green-400 text-sm mt-1"></p>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 w-32 text-sm text-center rounded-md shadow transition">
                            Feltöltés
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <!-- JOBB OLDAL -->
        <div class="space-y-8">
            <!-- Profilinformáció -->
            <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 p-6 rounded-xl shadow-sm transition-transform transform hover:scale-105 hover:shadow-lg duration-300">
                <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Profilinformáció</h2>
                @include('profile.partials.update-profile-information-form', ['user' => $user])
            </div>

            <!-- Jelszó -->
            <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 p-6 rounded-xl shadow-sm transition-transform transform hover:scale-105 hover:shadow-lg duration-300">
                <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Jelszó módosítása</h2>
                @include('profile.partials.update-password-form', ['user' => $user, 'guard' => $user instanceof \App\Models\Company ? 'company' : 'web'])
            </div>

            <!-- Fiók törlés -->
            <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 p-6 rounded-xl shadow-sm transition-transform transform hover:scale-105 hover:shadow-lg duration-300">
                <h2 class="text-xl font-bold mb-4 text-red-600 dark:text-red-400">Fiók törlése</h2>
                <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
                    @csrf
                    @method('DELETE')
                    <div>
                        <label for="password" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Jelszó megerősítése</label>
                        <input id="password" name="password" type="password" autocomplete="off" style="background-clip: padding-box;" 
                               class="w-1/2 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 
                                      bg-white dark:bg-[#2f3035] text-gray-800 dark:text-gray-100 
                                      placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none 
                                      focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition" />
                        <x-input-error :messages="$errors->userDeletion->get('password')" />
                    </div>
                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 w-24 text-sm text-center rounded-md shadow transition">
                            Törlés
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    const dropzone = document.getElementById('dropzone');
    const uploadInput = document.getElementById('profile_picture');
    const previewImg = document.getElementById('preview');
    const uploadText = document.getElementById('upload-text');


    uploadInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                previewImg.src = event.target.result;
                previewImg.classList.remove('hidden');
                uploadText.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
    </script>
</x-app-layout>