<x-app-layout>
    <div class="min-h-screen">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 mt-10 mb-16">
            @if (session('success'))
                <div 
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-transition 
                    x-init="setTimeout(() => show = false, 3000)" 
                    class="max-w-4xl mx-auto mt-8 mb-6 bg-green-100 border border-green-400 text-green-800 px-6 py-3 rounded-lg text-center shadow"
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
                    class="max-w-4xl mx-auto mt-8 mb-6 bg-red-100 border border-red-400 text-red-800 px-6 py-3 rounded-lg text-center shadow"
                >
                    ⚠️ {{ session('error') }}
                </div>
            @endif
            <h2 class="text-2xl font-bold mb-8 text-gray-900 dark:text-gray-100 text-center">Jelentkezéseim</h2>
            @if($applications->isEmpty())
                <div class="text-center text-gray-700 dark:text-gray-300 py-20 text-lg">
                    Még nem jelentkeztél egy állásra sem.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($applications as $application)
                        <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-5 transition-transform transform duration-300 hover:scale-105 hover:shadow-lg">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                {{ $application->job->title }}
                            </h3>

                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                📍 {{ $application->job->location }}
                            </p>
                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                🏢 {{ $application->job->company->name }}
                            </p>

                            <div class="mt-3">
                                @switch($application->status)
                                    @case('pending')
                                        <span class="px-3 py-1 text-sm font-medium rounded-full bg-yellow-100 dark:bg-yellow-600/30 text-yellow-700 dark:text-yellow-300">Függőben</span>
                                        @break
                                    @case('accepted')
                                        <span class="px-3 py-1 text-sm font-medium rounded-full bg-green-100 dark:bg-green-600/30 text-green-700 dark:text-green-300">Elfogadva</span>
                                        @break
                                    @case('rejected')
                                        <span class="px-3 py-1 text-sm font-medium rounded-full bg-red-100 dark:bg-red-600/30 text-red-700 dark:text-red-300">Elutasítva</span>
                                        @break
                                    @case('archived')
                                        <span class="px-3 py-1 text-sm font-medium rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300">Archivált</span>
                                        @break
                                    @default
                                        <span class="px-3 py-1 text-sm font-medium rounded-full bg-blue-100 dark:bg-blue-600/30 text-blue-700 dark:text-blue-300">{{ $application->status }}</span>
                                @endswitch
                            </div>

                            @if ($application->user && $application->user->resume)
                                <p class="mt-4 text-xs text-gray-500 dark:text-gray-400 italic">
                                    A jelentkezéshez a profilodon tárolt önéletrajz került felhasználásra.
                                </p>
                            @else
                                <p class="mt-4 text-xs text-red-600 dark:text-red-400 italic">
                                    Nem töltöttél fel önéletrajzot. Kérlek, tölts fel egyet a profilodban!
                                </p>
                            @endif

                            <form action="{{ url('/my-applications/' . $application->id) }}" method="POST" class="mt-5">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm shadow transition w-full">
                                    Törlés
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>