<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Álláshirdetés szerkesztése
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-6">

            <div class="bg-gray-800 shadow-sm rounded-lg p-6">
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
                        <input id="title" name="title" type="text"
                               class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-red-500"
                               value="{{ old('title', $job->title) }}" required autofocus />
                        <x-input-error class="mt-2 text-red-500" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="description" value="Leírás" class="text-white" />
                        <textarea id="description" name="description" rows="4"
                                  class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-red-500"
                                  required>{{ old('description', $job->description) }}</textarea>
                        <x-input-error class="mt-2 text-red-500" :messages="$errors->get('description')" />
                    </div>

                    <div>
                        <x-input-label for="location" value="Hely" class="text-white" />
                        <input id="location" name="location" type="text"
                               class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-red-500"
                               value="{{ old('location', $job->location) }}" required />
                        <x-input-error class="mt-2 text-red-500" :messages="$errors->get('location')" />
                    </div>

                    <div>
                        <x-input-label for="salary" value="Bérezés" class="text-white" />
                        <input id="salary" name="salary" type="text"
                               class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-red-500"
                               value="{{ old('salary', $job->salary) }}" required />
                        <x-input-error class="mt-2 text-red-500" :messages="$errors->get('salary')" />
                    </div>

                    <div>
                        <x-input-label for="type" value="Típus" class="text-white" />
                        <input id="type" name="type" type="text"
                               class="w-full px-3 py-2 rounded-md bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-red-500"
                               value="{{ old('type', $job->type) }}" required />
                        <x-input-error class="mt-2 text-red-500" :messages="$errors->get('type')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button class="bg-gray-900 hover:bg-gray-700">
                            Frissítés
                        </x-primary-button>

                        <a href="{{ route('jobs.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Mégse
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>