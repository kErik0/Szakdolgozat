<x-app-layout>
    <main class="flex-1 flex justify-center min-h-screen"
          :style="darkMode 
            ? 'background-color: #1f2937; color: rgb(230,231,235); transition: background-color 300ms, color 300ms;' 
            : 'background-color: #ffffff; color: rgb(33,41,54); transition: background-color 300ms, color 300ms;'">
        <div class="w-full max-w-7xl p-6 rounded-lg"
             :style="darkMode 
                ? 'background-color: #3b4b63; color: rgb(230,231,235); border-color: #475569; transition: background-color 300ms, color 300ms, border-color 300ms;' 
                : 'background-color: #f3f4f6; color: rgb(33,41,54); border-color: #e5e7eb; transition: background-color 300ms, color 300ms, border-color 300ms;'">
            
            @if(session('success'))
                <div class="mb-4 bg-green-600 text-white rounded-lg p-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6 inline-block w-auto mx-auto flex justify-center">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-gray-900 dark:text-gray-100 border-collapse">
                        <thead class="bg-gray-200 dark:bg-gray-600">
                            <tr>
                                <th class="px-6 py-3 font-semibold text-left">Cím</th>
                                <th class="px-6 py-3 font-semibold text-left">Hely</th>
                                <th class="px-6 py-3 font-semibold text-left">Bérezés</th>
                                <th class="px-6 py-3 font-semibold text-center">Műveletek</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job)
                                <tr class="border-b border-gray-300 dark:border-gray-500 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-150">
                                    <td class="px-6 py-4 align-middle font-medium">{{ $job->title }}</td>
                                    <td class="px-6 py-4 align-middle">{{ $job->location }}</td>
                                    <td class="px-6 py-4 align-middle">{{ number_format($job->salary, 0, ',', ' ') }} Ft</td>
                                    <td class="px-6 py-4 align-middle">
                                        <div class="flex justify-center space-x-4">
                                            <a href="{{ route('jobs.applications', $job->id) }}" 
                                               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                                                Jelentkezettek
                                            </a>
                                            <a href="{{ route('jobs.edit', $job->id) }}" 
                                               class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded transition">
                                                Szerkesztés
                                            </a>
                                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="inline-flex items-center">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Biztosan törölni szeretnéd?')" 
                                                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded transition">
                                                    Törlés
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
