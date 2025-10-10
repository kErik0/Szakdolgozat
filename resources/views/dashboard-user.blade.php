<x-app-layout>
    <!-- Oldal fejléc -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Felhasználói Irányítópult
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Munkamenet üzenetek -->
            @if (session('success'))
                <div class="mb-4 bg-green-600 text-white rounded-lg p-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 bg-red-600 text-white rounded-lg p-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Felhasználói adatok -->
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-100 mb-2">Üdvözlünk, {{ Auth::user()->name }}</h2>
                <p class="text-gray-300"><strong>Szerepkör:</strong> {{ Auth::user()->role }}</p>
            </div>

            <!-- Állások -->
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-100 mb-4">Elérhető állásajánlatok</h2>

                @if(isset($jobs) && count($jobs) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-gray-100">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2">Cím</th>
                                    <th class="px-4 py-2">Leírás</th>
                                    <th class="px-4 py-2">Helyszín</th>
                                    <th class="px-4 py-2">Fizetés</th>
                                    <th class="px-4 py-2">Típus</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $job)
                                    <tr class="border-b border-gray-600">
                                        <td class="px-4 py-2">{{ $job->title }}</td>
                                        <td class="px-4 py-2">{{ $job->description }}</td>
                                        <td class="px-4 py-2">{{ $job->location }}</td>
                                        <td class="px-4 py-2">{{ $job->salary }}</td>
                                        <td class="px-4 py-2">{{ $job->type }}</td>
                                        <td class="px-4 py-2">
                                            <form method="POST" action="{{ route('jobs.apply', $job->id) }}">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1 px-3 rounded disabled:bg-gray-500 disabled:cursor-not-allowed"
                                                    @if(in_array($job->id, $appliedJobs)) disabled @endif>
                                                    @if(in_array($job->id, $appliedJobs))
                                                        Már jelentkezett
                                                    @else
                                                        Jelentkezés
                                                    @endif
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-gray-300 py-4">
                        Jelenleg nincs elérhető állásajánlat.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>