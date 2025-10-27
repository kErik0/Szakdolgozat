<x-app-layout>
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">

        <!-- BAL OLDAL -->
        <div class="space-y-8">
            <!-- Profilkép blokk -->
            <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 p-6 rounded-xl shadow-sm">
                <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Profilkép</h2>
                <div id="dropzone" class="relative w-40 h-40 mx-auto border-2 border-dashed rounded-full flex items-center justify-center cursor-pointer hover:border-gray-400 transition">
                    <input type="file" name="profile_picture" id="profile_picture" class="absolute inset-0 opacity-0 cursor-pointer">
                    @if($user->profile_picture && file_exists(public_path($user->profile_picture)))
                        <img id="preview" src="{{ asset($user->profile_picture) }}" class="w-40 h-40 rounded-full object-cover border border-gray-300 dark:border-gray-700">
                    @else
                        <span id="upload-text" class="text-gray-500 dark:text-gray-300">Húzd ide a képet</span>
                    @endif
                </div>
                <div class="flex justify-center mt-4 gap-4">
                    <form method="POST" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data" class="flex flex-col items-center gap-3">
                        @csrf
                        <input type="file" name="profile_picture" accept="image/*" required class="hidden" id="profileUpload">
                        <button type="submit" class="btn">Mentés</button>
                    </form>
                    <form method="POST" action="{{ route('profile.photo.destroy') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white">Törlés</button>
                    </form>
                </div>
            </div>

            <!-- CV blokk -->
            <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 p-6 rounded-xl shadow-sm">
                <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">CV kezelése</h2>
                @php
                    $cvFile = $user->resume;
                @endphp
                @if($cvFile && file_exists(storage_path('app/public/cvs/' . $cvFile)))
                    <div class="mb-4">
                        <a href="{{ asset('storage/cvs/' . $cvFile) }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">Feltöltött CV megtekintése</a>
                    </div>
                    <form method="POST" action="{{ route('profile.cv.destroy') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white">CV törlése</button>
                    </form>
                @else
                    <div class="text-gray-700 dark:text-gray-300 mb-4">Nincs feltöltött CV</div>
                @endif

                <form method="POST" action="{{ route('profile.cv.update') }}" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    <input type="file" name="cv" accept=".pdf,.doc,.docx" required class="text-gray-700 dark:text-gray-300 mb-3">
                    <button type="submit" class="btn">Új CV feltöltése</button>
                </form>
            </div>
        </div>

        <!-- JOBB OLDAL -->
        <div class="space-y-8">
            <!-- Profilinformáció -->
            <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 p-6 rounded-xl shadow-sm">
                <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Profilinformáció</h2>
                @include('profile.partials.update-profile-information-form', ['user' => $user])
            </div>

            <!-- Jelszó -->
            <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 p-6 rounded-xl shadow-sm">
                <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Jelszó módosítása</h2>
                @include('profile.partials.update-password-form', ['user' => $user, 'guard' => $user instanceof \App\Models\Company ? 'company' : 'web'])
            </div>

            <!-- Fiók törlés -->
            <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 p-6 rounded-xl shadow-sm">
                <h2 class="text-xl font-bold mb-4 text-red-600 dark:text-red-400">Fiók törlése</h2>
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')
                    <label for="password" class="text-gray-700 dark:text-gray-300 block mb-2">Jelszó megerősítés</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password" class="input w-full mb-4">
                    <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white w-full">Fiók törlése</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const uploadInput = document.getElementById('profile_picture');
        const previewImg = document.getElementById('preview');
        const uploadText = document.getElementById('upload-text');
        uploadInput?.addEventListener('change', function(e) {
            const [file] = e.target.files;
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                    uploadText.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>