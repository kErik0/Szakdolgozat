<x-app-layout>
    <main class="flex-1 flex justify-center min-h-screen"
          :style="darkMode 
            ? 'background-color: #1f2937; color: rgb(230,231,235); transition: background-color 300ms, color 300ms;' 
            : 'background-color: #ffffff; color: rgb(33,41,54); transition: background-color 300ms, color 300ms;'">
        <div class="w-full max-w-7xl p-6 rounded-lg"
             :style="darkMode 
                ? 'background-color: #3b4b63; color: rgb(230,231,235); border-color: #475569; transition: background-color 300ms, color 300ms, border-color 300ms;' 
                : 'background-color: #f3f4f6; color: rgb(33,41,54); border-color: #e5e7eb; transition: background-color 300ms, color 300ms, border-color 300ms;'">
            
            <div class="flex justify-center">
                <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6 w-full max-w-xl">
                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('jobs.update', $job->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="title" value="Cím" class="text-white" />
                            <input id="title" name="title" type="text" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('title', $job->title) }}" required autofocus />
                            <x-input-error class="mt-2 text-red-500" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Leírás" class="text-white" />
                            <textarea id="description" name="description" rows="4" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" required>{{ old('description', $job->description) }}</textarea>
                            <x-input-error class="mt-2 text-red-500" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="location" value="Hely" class="text-white" />
                            <input id="location" name="location" type="text"
                                   class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('location', $job->location) }}" required />
                            <x-input-error class="mt-2 text-red-500" :messages="$errors->get('location')" />
                        </div>

                        <div>
                            <x-input-label for="salary" value="Bérezés" class="text-white" />
                            <input id="salary" name="salary" type="text"
                                   class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('salary', $job->salary) }}" required />
                            <x-input-error class="mt-2 text-red-500" :messages="$errors->get('salary')" />
                        </div>

                        <div>
                            <x-input-label for="type" value="Típus" class="text-white" />
                            <input id="type" name="type" type="text"
                                   class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('type', $job->type) }}" required />
                            <x-input-error class="mt-2 text-red-500" :messages="$errors->get('type')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="bg-gray-900 hover:bg-gray-700">
                                Frissítés
                            </x-primary-button>

                            <x-primary-button class="bg-gray-900 hover:bg-gray-700" onclick="window.location='{{ route('jobs.index') }}'">
                                Mégse
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>