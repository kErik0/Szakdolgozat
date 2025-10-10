<x-app-layout>
    <x-slot name="header">
        {{ $job->title }}
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-6 bg-gray-800 p-6 rounded-lg">
            @if($applications->count() > 0)
                <div class="space-y-4">
                    @foreach($applications as $application)
                        <div class="bg-gray-900 shadow-sm rounded-lg p-6 flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <p class="text-lg font-semibold">{{ $application->user->name }}</p>
                                <p class="text-sm text-gray-300">{{ $application->user->email }}</p>
                                <p class="mt-1">Status: <span class="font-medium">
                                    @if($application->status === 'pending')
                                        Függőben
                                    @elseif($application->status === 'accepted')
                                        Elfogadva
                                    @elseif($application->status === 'rejected')
                                        Elutasítva
                                    @else
                                        {{ ucfirst($application->status) }}
                                    @endif
                                </span></p>
                                <div class="mt-2">
                                    <span class="font-medium">CV: </span>
                                    @if($application->user->resume)
                                        <a href="{{ asset('storage/cvs/' . $application->user->resume) }}" target="_blank" class="text-blue-400 underline">Megtekintés</a>
                                    @else
                                        <span class="text-gray-400">Nincs feltöltve</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-4 md:mt-0 flex space-x-2">
                                @if($application->status === 'accepted' || $application->status === 'rejected')
                                    <form action="{{ route('applications.destroy', $application->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="x-primary-button bg-gray-900 hover:bg-gray-700 px-4 py-2 rounded text-white">Törlés</button>
                                    </form>
                                @else
                                    <form action="{{ route('applications.accept', $application->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="x-primary-button bg-gray-900 hover:bg-gray-700 px-4 py-2 rounded text-white">Elfogad</button>
                                    </form>
                                    <form action="{{ route('applications.reject', $application->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="x-primary-button bg-red-600 hover:bg-red-700 px-4 py-2 rounded text-white">Elutasít</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400">Nincsenek jelentkezések ehhez az álláshoz.</p>
            @endif
        </div>
    </div>
</x-app-layout>
