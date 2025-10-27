<x-app-layout>
        <div>
            <div>
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

                    <form action="{{ route('jobs.update', $job->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="title" value="Cím" />
                            <input id="title" name="title" type="text"
                                   value="{{ old('title', $job->title) }}" required autofocus />
                            <x-input-error :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Leírás" />
                            <textarea id="description" name="description" rows="4" required>{{ old('description', $job->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="location" value="Hely" />
                            <input id="location" name="location" type="text"
                                   value="{{ old('location', $job->location) }}" required />
                            <x-input-error :messages="$errors->get('location')" />
                        </div>

                        <div>
                            <x-input-label for="salary" value="Bérezés" />
                            <input id="salary" name="salary" type="text"
                                   value="{{ old('salary', $job->salary) }}" required />
                            <x-input-error :messages="$errors->get('salary')" />
                        </div>

                        <div>
                            <x-input-label for="type" value="Típus" />
                            <input id="type" name="type" type="text"
                                   value="{{ old('type', $job->type) }}" required />
                            <x-input-error :messages="$errors->get('type')" />
                        </div>

                        <div>
                            <x-primary-button>
                                Frissítés
                            </x-primary-button>

                            <x-primary-button onclick="window.location='{{ route('jobs.index') }}'">
                                Mégse
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>