<x-app-layout>
    <x-slot name="header">
        Összes álláshirdetés
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-6 bg-gray-800 p-6 rounded-lg">
            @if(session('success'))
                <div class="text-green-500 mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-gray-900 shadow-sm rounded-lg p-6">
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="bg-gray-100 text-gray-700 font-semibold px-6 py-3 border-b border-gray-200">Cím</th>
                            <th class="bg-gray-100 text-gray-700 font-semibold px-6 py-3 border-b border-gray-200">Leírás</th>
                            <th class="bg-gray-100 text-gray-700 font-semibold px-6 py-3 border-b border-gray-200">Hely</th>
                            <th class="bg-gray-100 text-gray-700 font-semibold px-6 py-3 border-b border-gray-200">Bérezés</th>
                            <th class="bg-gray-100 text-gray-700 font-semibold px-6 py-3 border-b border-gray-200">Típus</th>
                            <th class="bg-gray-100 text-gray-700 font-semibold px-6 py-3 border-b border-gray-200">Jelentkezés</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                        <tr class="even:bg-gray-800 odd:bg-gray-900">
                            <td class="border-b border-gray-200 px-6 py-4 text-gray-300">{{ $job->title }}</td>
                            <td class="border-b border-gray-200 px-6 py-4 text-gray-300">{{ $job->description }}</td>
                            <td class="border-b border-gray-200 px-6 py-4 text-gray-300">{{ $job->location }}</td>
                            <td class="border-b border-gray-200 px-6 py-4 text-gray-300">{{ $job->salary }}</td>
                            <td class="border-b border-gray-200 px-6 py-4 text-gray-300">{{ $job->type }}</td>
                            <td class="border-b border-gray-200 px-6 py-4 text-gray-300">
                                <form action="{{ route('jobs.apply', $job->id) }}" method="POST">
                                    @csrf
                                    <x-primary-button type="submit" class="bg-gray-700 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded transition-colors">
                                        Jelentkezés
                                    </x-primary-button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>