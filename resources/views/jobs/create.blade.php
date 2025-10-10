<x-app-layout>
    <x-slot name="header">
        Új álláshirdetés létrehozása
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-6 bg-gray-800 p-6 rounded-lg">
            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('jobs.store') }}" method="POST" class="flex flex-col gap-6">
                @csrf
                <div>
                    <x-input-label for="title" :value="'Cím:'" class="text-white" />
                    <x-text-input type="text" name="title" id="title" value="{{ old('title') }}" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="description" :value="'Leírás:'" class="text-white" />
                    <x-text-input as="textarea" name="description" id="description" class="mt-1 block w-full h-32" >{{ old('description') }}</x-text-input>
                </div>
                <div>
                    <x-input-label for="location" :value="'Hely:'" class="text-white" />
                    <x-text-input type="text" name="location" id="location" value="{{ old('location') }}" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="salary" :value="'Bérezés:'" class="text-white" />
                    <x-text-input type="text" name="salary" id="salary" value="{{ old('salary') }}" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="type" :value="'Típus:'" class="text-white" />
                    <x-text-input type="text" name="type" id="type" value="{{ old('type') }}" class="mt-1 block w-full" />
                </div>
                <div class="mt-4">
                    <x-primary-button class="bg-gray-900 hover:bg-gray-700">
                        Mentés
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>