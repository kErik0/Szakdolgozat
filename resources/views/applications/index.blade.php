<x-app-layout>
    <main class="flex-1 flex justify-center min-h-screen"
          :style="darkMode 
            ? 'background-color: #1f2937; color: rgb(230,231,235); transition: background-color 300ms, color 300ms;' 
            : 'background-color: #ffffff; color: rgb(33,41,54); transition: background-color 300ms, color 300ms;'">
        <div class="w-full max-w-7xl p-6 rounded-lg"
             :style="darkMode 
                ? 'background-color: #3b4b63; color: rgb(230,231,235); border-color: #475569; transition: background-color 300ms, color 300ms, border-color 300ms;' 
                : 'background-color: #f3f4f6; color: rgb(33,41,54); border-color: #e5e7eb; transition: background-color 300ms, color 300ms, border-color 300ms;'">
            @if($applications->isEmpty())
                <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center text-gray-800 dark:text-gray-200">
                    Még nem jelentkeztél egy állásra sem.
                </div>
            @else
                <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6 inline-block w-auto mx-auto flex justify-center">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-gray-900 dark:text-gray-100 border-collapse">
                            <thead class="bg-gray-200 dark:bg-gray-600">
                                <tr>
                                    <th class="px-6 py-3 font-semibold text-left">Állás címe</th>
                                    <th class="px-6 py-3 font-semibold text-left">Hely</th>
                                    <th class="px-6 py-3 font-semibold text-left">Cég neve</th>
                                    <th class="px-6 py-3 font-semibold text-left">Státusz</th>
                                    <th class="px-6 py-3 font-semibold text-left">CV</th>
                                    <th class="px-6 py-3 font-semibold text-center">Műveletek</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applications as $application)
                                    <tr class="border-b border-gray-300 dark:border-gray-500 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-150">
                                        <td class="px-6 py-4 align-middle font-medium">{{ $application->job->title }}</td>
                                        <td class="px-6 py-4 align-middle">{{ $application->job->location }}</td>
                                        <td class="px-6 py-4 align-middle">{{ $application->job->company->name }}</td>
                                        <td class="px-6 py-4 align-middle">
                                            @switch($application->status)
                                                @case('pending')
                                                    Függőben
                                                    @break
                                                @case('accepted')
                                                    Elfogadva
                                                    @break
                                                @case('rejected')
                                                    Elutasítva
                                                    @break
                                                @default
                                                    {{ $application->status }}
                                            @endswitch
                                        </td>
                                        <td class="px-6 py-4 align-middle">
                                            @if($application->user->resume)
                                                <a href="{{ asset('storage/cvs/' . $application->user->resume) }}" target="_blank" class="text-blue-500 underline">Megtekintés</a>
                                            @else
                                                <span class="text-gray-400">Nincs feltöltve</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 align-middle text-center">
                                            <form action="{{ route('applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Biztosan törölni szeretnéd a jelentkezésed?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded transition">
                                                    Törlés
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </main>
</x-app-layout>