<x-app-layout>
    <div>   
        @if($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('jobs.store') }}" method="POST">
            @csrf

            <div>
                <x-input-label for="title" value="Cím" />
                <input id="title" name="title" type="text" value="{{ old('title') }}" required autofocus />
                <x-input-error :messages="$errors->get('title')" />
            </div>

            <div>
                <x-input-label for="description" value="Leírás" />
                <textarea id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" />
            </div>

            <div>
                <x-input-label for="location" value="Hely" />
                <input id="location" name="location" type="text" value="{{ old('location') }}" required />
                <x-input-error :messages="$errors->get('location')" />
            </div>

            <div>
                <x-input-label for="salary" value="Bérezés" />
                <input id="salary" name="salary" type="text" value="{{ old('salary') }}" required />
                <x-input-error :messages="$errors->get('salary')" />
            </div>

            <div>
                <x-input-label for="type" value="Típus" />
                <input id="type" name="type" type="text" value="{{ old('type') }}" required />
                <x-input-error :messages="$errors->get('type')" />
            </div>

            <div>
                <x-primary-button>
                    Mentés
                </x-primary-button>

                <x-primary-button onclick="window.location='{{ route('jobs.index') }}'" type="button">
                    Mégse
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>