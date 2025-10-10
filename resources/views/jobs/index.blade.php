<x-app-layout>
    <x-slot name="header">
        Álláshirdetések
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-6 bg-gray-800 p-6 rounded-lg">

            @if(session('success'))
                <div class="text-green-500 text-gray-100 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-900 shadow-sm rounded-lg p-6">
                <table class="table-auto w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-800">
                            <th class="text-gray-100 font-medium px-6 py-3">Cím</th>
                            <th class="text-gray-100 font-medium px-6 py-3">Leírás</th>
                            <th class="text-gray-100 font-medium px-6 py-3">Hely</th>
                            <th class="text-gray-100 font-medium px-6 py-3">Bérezés</th>
                            <th class="text-gray-100 font-medium px-6 py-3">Típus</th>
                            <th class="text-gray-100 font-medium px-6 py-3">Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                        <tr class="even:bg-gray-800 odd:bg-gray-900">
                            <td class="px-6 py-4 text-gray-100">{{ $job->title }}</td>
                            <td class="px-6 py-4 text-gray-100">{{ $job->description }}</td>
                            <td class="px-6 py-4 text-gray-100">{{ $job->location }}</td>
                            <td class="px-6 py-4 text-gray-100">{{ $job->salary }}</td>
                            <td class="px-6 py-4 text-gray-100">{{ $job->type }}</td>
                            <td class="px-6 py-4 text-gray-100">
                                <a href="{{ route('jobs.applications', $job->id) }}" class="x-primary-button mr-2">Jelentkezettek</a>
                                <a href="{{ route('jobs.edit', $job->id) }}" class="x-primary-button mr-2">Szerkesztés</a>
                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Biztosan törölni szeretnéd?')" class="x-primary-button bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Törlés</button>
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