<x-app-layout>
    @if (session('success'))
        <div class="max-w-4xl mx-auto mt-6 bg-green-100 border border-green-400 text-green-800 px-6 py-3 rounded-lg text-center shadow" 
             x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition>
            ✅ {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-4xl mx-auto mt-6 bg-red-100 border border-red-400 text-red-800 px-6 py-3 rounded-lg text-center shadow" 
             x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition>
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-col justify-center items-center min-h-[80vh] px-4 sm:px-6 lg:px-8">
        <form action="{{ route('jobs.update', $job->id) }}" method="POST" class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 p-8 rounded-xl shadow-sm w-full max-w-2xl space-y-6">    
            @csrf
            @method('PUT')

            <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-gray-100 mb-6 tracking-wide">Állás módosítása</h2>

            <div class="mb-4">
                <label for="title" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Cím</label>
                <input id="title" name="title" type="text" value="{{ old('title', $job->title) }}" required autofocus
                       class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 
                              text-gray-800 dark:text-gray-100 
                              placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none 
                              focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition" />
                <x-input-error :messages="$errors->get('title')" />
            </div>

            <div class="mb-4">
                <label for="description" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Leírás</label>
                <textarea id="description" name="description" rows="5" required
                          class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 
                                 text-gray-800 dark:text-gray-100 
                                 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none 
                                 focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition">{{ old('description', $job->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" />
            </div>

            <div class="mb-4">
                <label for="location" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Hely</label>
                <input id="location" name="location" type="text" value="{{ old('location', $job->location) }}" required
                       class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 
                              text-gray-800 dark:text-gray-100 
                              placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none 
                              focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition" />
                <x-input-error :messages="$errors->get('location')" />
            </div>

            <div class="mb-4">
                <label for="salary" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Bérezés</label>
                <input id="salary" name="salary" type="text" value="{{ old('salary', $job->salary) }}" required
                       class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 
                              text-gray-800 dark:text-gray-100 
                              placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none 
                              focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition" />
                <x-input-error :messages="$errors->get('salary')" />
            </div>

            <div class="mb-4">
                <label for="type" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Típus</label>
                <select id="type" name="type" required
                        class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 
                               text-gray-800 dark:text-gray-100 
                               placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none 
                               focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition">
                    <option value="">Válassz típust</option>
                    <option value="Teljes munkaidő" {{ old('type', $job->type) == 'Teljes munkaidő' ? 'selected' : '' }}>Teljes munkaidő</option>
                    <option value="Rész munkaidő" {{ old('type', $job->type) == 'Rész munkaidő' ? 'selected' : '' }}>Rész munkaidő</option>
                    <option value="Gyakornok" {{ old('type', $job->type) == 'Gyakornok' ? 'selected' : '' }}>Gyakornok</option>
                    <option value="Hibrid" {{ old('type', $job->type) == 'Hibrid' ? 'selected' : '' }}>Hibrid</option>
                </select>
                <x-input-error :messages="$errors->get('type')" />
            </div>

            <div class="flex justify-center gap-4 mt-6">
                <button type="submit" class="btn w-24 text-center">
                    Mentés
                </button>
                <a href="{{ route('jobs.index') }}" class="btn w-24 text-center">
                    Mégse
                </a>
            </div>
        </form>
    </div>
</x-app-layout>