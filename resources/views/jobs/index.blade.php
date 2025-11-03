<x-app-layout>
    <div class="min-h-screen">
        <div class="max-w-6xl mx-auto px-6">
            <h1 class="text-3xl font-bold text-center mb-8 text-gray-900 dark:text-gray-100">Hirdetéseim</h1>

            @if (session('success'))
                <div 
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-transition 
                    x-init="setTimeout(() => show = false, 3000)" 
                    class="max-w-4xl mx-auto mt-6 bg-green-100 border border-green-400 text-green-800 px-6 py-3 rounded-lg text-center shadow"
                >
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div 
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-transition 
                    x-init="setTimeout(() => show = false, 3000)" 
                    class="max-w-4xl mx-auto mt-6 bg-red-100 border border-red-400 text-red-800 px-6 py-3 rounded-lg text-center shadow"
                >
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            @if($jobs->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                    @foreach($jobs as $job)
                        <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm transition-transform transform hover:scale-105 hover:shadow-lg duration-300">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">{{ $job->title }}</h2>
                            <p class="text-gray-700 dark:text-gray-300"><strong>Hely:</strong> {{ $job->location }}</p>
                            <p class="text-gray-700 dark:text-gray-300"><strong>Bérezés:</strong> {{ number_format($job->salary, 0, ',', ' ') }} Ft</p>
                            
                            <div class="flex flex-col gap-2 mt-4">
                                <form action="{{ route('jobs.applications', $job->id) }}" method="GET">
                                    <button type="submit" class="bg-[#1f1f1f] dark:bg-gray-800 hover:bg-gray-900 dark:hover:bg-gray-700 text-white py-1 px-3 rounded-md text-center text-sm font-medium shadow-sm transition w-full">
                                        Jelentkezettek
                                    </button>
                                </form>
                                <form action="{{ route('jobs.edit', $job->id) }}" method="GET">
                                    <button type="submit" class="bg-[#1f1f1f] dark:bg-gray-800 hover:bg-gray-900 dark:hover:bg-gray-700 text-white py-1 px-3 rounded-md text-center text-sm font-medium shadow-sm transition w-full">
                                        Szerkesztés
                                    </button>
                                </form>
                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="bg-[#1f1f1f] dark:bg-gray-800 hover:bg-gray-900 dark:hover:bg-gray-700 text-white py-1 px-3 rounded-md text-center text-sm font-medium shadow-sm transition w-full">
                                        Törlés
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600 dark:text-gray-300 mt-10">Még nem adtál hozzá állásokat.</p>
            @endif
        </div>
    </div>
</x-app-layout>
