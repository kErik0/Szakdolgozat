<x-app-layout>
    <main class="flex-1 flex justify-center min-h-screen"
          :style="darkMode 
            ? 'background-color: #1f2937; color: rgb(230,231,235); transition: background-color 300ms, color 300ms;' 
            : 'background-color: #ffffff; color: rgb(33,41,54); transition: background-color 300ms, color 300ms;'">
        <div class="w-full max-w-7xl p-6 rounded-lg"
             :style="darkMode 
                ? 'background-color: #3b4b63; color: rgb(230,231,235); border-color: #475569; transition: background-color 300ms, color 300ms, border-color 300ms;' 
                : 'background-color: #f3f4f6; color: rgb(33,41,54); border-color: #e5e7eb; transition: background-color 300ms, color 300ms, border-color 300ms;'">
            
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
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Üdvözlünk, {{ Auth::user()->name }}</h2>
                <p class="text-gray-700 dark:text-gray-200"><strong>Szerepkör:</strong> {{ Auth::user()->role }}</p>
            </div>

            <!-- Állások -->
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Elérhető állásajánlatok</h2>

                @if(isset($jobs) && count($jobs) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-gray-900 dark:text-gray-100">
                            <thead class="bg-gray-200 dark:bg-gray-600">
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
                                    <tr class="border-b border-gray-300 dark:border-gray-500">
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
                    <div class="text-center text-gray-700 dark:text-gray-200 py-4">
                        Jelenleg nincs elérhető állásajánlat.
                    </div>
                @endif

            </div>
        </div>
    </main>
</x-app-layout>