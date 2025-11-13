<x-app-layout>
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
    <!-- Hero banner képpel -->
    <section class="relative text-white py-20 rounded-2xl shadow-md text-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=2000&q=80" 
             alt="Office teamwork" 
             class="absolute inset-0 w-full h-full object-cover opacity-40 dark:opacity-30">
        <div class="relative z-10 text-center px-10 py-8 max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-black dark:text-white">
                Találd meg álmaid munkáját!
            </h1>
            <p class="text-lg mb-8 text-black dark:text-white">
                Böngéssz több száz aktuális állásajánlat között – naponta frissítve
            </p>
            <a href="{{ route('jobs.browse') }}" class="bg-white text-gray-900 font-semibold px-6 py-3 rounded-lg shadow hover:bg-gray-100 transition">
                🔍 Fedezd fel most
            </a>
        </div>
    </section>

    <!-- Kategóriák teljes hátteres kártyákkal -->
    <section class="max-w-6xl mx-auto mt-16 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-8">Kategóriák</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="{{ route('jobs.browse', ['category' => 'it']) }}" 
               class="relative rounded-xl overflow-hidden shadow-md group h-24 hover:shadow-xl transition">
                <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition"></div>
                <span class="relative z-10 text-white text-xl font-semibold flex items-center justify-center h-full">
                    💻 Informatika
                </span>
            </a>

            <a href="{{ route('jobs.browse', ['category' => 'penzugy']) }}" 
               class="relative rounded-xl overflow-hidden shadow-md group h-24 hover:shadow-xl transition">
                <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition"></div>
                <span class="relative z-10 text-white text-xl font-semibold flex items-center justify-center h-full">
                    💰 Pénzügy
                </span>
            </a>

            <a href="{{ route('jobs.browse', ['category' => 'epitoipar']) }}" 
               class="relative rounded-xl overflow-hidden shadow-md group h-24 hover:shadow-xl transition">
                <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition"></div>
                <span class="relative z-10 text-white text-xl font-semibold flex items-center justify-center h-full">
                    🏗️ Építőipar
                </span>
            </a>

            <a href="{{ route('jobs.browse', ['category' => 'ugyfelszolgalat']) }}" 
               class="relative rounded-xl overflow-hidden shadow-md group h-24 hover:shadow-xl transition">
                <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition"></div>
                <span class="relative z-10 text-white text-xl font-semibold flex items-center justify-center h-full">
                    🧑‍💼 Ügyfélszolgálat
                </span>
            </a>

            <a href="{{ route('jobs.browse', ['category' => 'vendeglatas']) }}" 
               class="relative rounded-xl overflow-hidden shadow-md group h-24 hover:shadow-xl transition">
                <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition"></div>
                <span class="relative z-10 text-white text-xl font-semibold flex items-center justify-center h-full">
                    🍽️ Vendéglátás
                </span>
            </a>

            <a href="{{ route('jobs.browse', ['category' => 'logisztika']) }}" 
               class="relative rounded-xl overflow-hidden shadow-md group h-24 hover:shadow-xl transition">
                <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition"></div>
                <span class="relative z-10 text-white text-xl font-semibold flex items-center justify-center h-full">
                    🚚 Logisztika
                </span>
            </a>
        </div>
    </section>

    <!-- Kiemelt cégek képekkel -->
    <section class="max-w-6xl mx-auto mt-20 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-8">🏢 Kiemelt partnereink</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
            @foreach(App\Models\Company::take(4)->get() as $company)
                <a href="{{ route('companies', $company->id) }}" class="block transition-transform transform hover:scale-105 duration-300">
                    <div class="job-card bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-8 hover:shadow-lg text-center">
                        
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2 text-center">{{ $company->name }}</h3>
                        <p class="text-center text-gray-600 dark:text-gray-300 text-sm">{{ Str::limit($company->description ?? 'Nincs leírás', 80) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

       <!-- Munkamenet üzenetek -->
            

    <!-- Fő csempe konténer -->
    <div class="max-w-7xl mx-auto mt-16 bg-white dark:bg-[#2b2b2b] rounded-xl shadow-sm p-10">

        @guest
            <div class="min-h-[400px] flex flex-col">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6 text-center">
                    👀 Legutóbb megtekintett állások
                </h2>

                @if(isset($viewedJobs) && $viewedJobs->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 flex-1">
                        @foreach($viewedJobs as $job)
                            <div class="job-card bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6 transition-transform transform hover:scale-105 hover:shadow-lg duration-300">
                                @if($job->company && $job->company->logo && file_exists(public_path($job->company->logo)))
                                    <div class="flex justify-center mb-4">
                                        <img src="{{ asset($job->company->logo) }}" alt="{{ $job->company->name }}" class="w-20 h-20 object-cover rounded-full">
                                    </div>
                                @else
                                    <div class="w-20 h-20 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-full mx-auto mb-4 text-gray-500 dark:text-gray-300">N/A</div>
                                @endif

                                <h3 class="text-lg font-semibold text-center mb-2 text-gray-900 dark:text-gray-100">{{ $job->title }}</h3>
                                <p class="text-center text-gray-500 dark:text-gray-400 text-sm mb-1">{{ $job->position }}</p>
                                <p class="text-center text-gray-600 dark:text-gray-300">{{ $job->location }}</p>
                                <p class="text-center text-gray-600 dark:text-gray-300">{{ $job->type }}</p>
                                <p class="text-center text-gray-800 dark:text-gray-200 font-medium mt-2">
                                    {{ number_format($job->salary, 0, ',', ' ') }} Ft /
                                    {{ $job->salary_type === 'órabér' ? 'óra' : 'hó' }}
                                </p>

                                <div class="text-center mt-4">
                                    <a href="{{ route('jobs.show', $job->id) }}" class="btn">
                                        Részletek
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex justify-center items-center flex-1">
                        <p class="text-gray-600 dark:text-gray-300 text-lg">
                            💡 Még nincs megtekintett állásod.
                        </p>
                    </div>
                @endif
            </div>
        @endguest

        @auth
            <div class="min-h-[400px] flex flex-col">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6 text-center">
                    🔍 Ajánlott állások neked
                </h2>

                @if(isset($recommendedJobs) && $recommendedJobs->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 flex-1">
                        @foreach($recommendedJobs as $job)
                            <div class="job-card bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6 transition-transform transform hover:scale-105 hover:shadow-lg duration-300">
                                @if($job->company && $job->company->logo && file_exists(public_path($job->company->logo)))
                                    <div class="flex justify-center mb-4">
                                        <img src="{{ asset($job->company->logo) }}" alt="{{ $job->company->name }}" class="w-20 h-20 object-cover rounded-full">
                                    </div>
                                @else
                                    <div class="w-20 h-20 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-full mx-auto mb-4 text-gray-500 dark:text-gray-300">N/A</div>
                                @endif

                                <h3 class="text-lg font-semibold text-center mb-2 text-gray-900 dark:text-gray-100">{{ $job->title }}</h3>
                                <p class="text-center text-gray-500 dark:text-gray-400 text-sm mb-1">{{ $job->position }}</p>
                                <p class="text-center text-gray-600 dark:text-gray-300">{{ $job->location }}</p>
                                <p class="text-center text-gray-600 dark:text-gray-300">{{ $job->type }}</p>
                                <p class="text-center text-gray-800 dark:text-gray-200 font-medium mt-2">
                                    {{ number_format($job->salary, 0, ',', ' ') }} Ft /
                                    {{ $job->salary_type === 'órabér' ? 'óra' : 'hó' }}
                                </p>

                                <div class="text-center mt-4">
                                    <a href="{{ route('jobs.show', $job->id) }}" class="btn">
                                        Részletek
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex justify-center items-center flex-1">
                        <p class="text-gray-600 dark:text-gray-300 text-lg">
                            🤖 Még nincs ajánlott állás számodra.
                        </p>
                    </div>
                @endif
            </div>
        @endauth
    </div>

</x-app-layout>