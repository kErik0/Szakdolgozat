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
    <div class="max-w-4xl mx-auto mt-12 mb-20 text-text-light dark:text-text-dark">
        <div class="grid md:grid-cols-2 gap-8 items-center text-left">
            {{-- Bal oldal: cégadatok --}}
            <div class="space-y-4 text-center md:text-left">
                @if($job->company && $job->company->logo && file_exists(public_path($job->company->logo)))
                    <img src="{{ asset($job->company->logo) }}" alt="{{ $job->company->name }}" class="w-24 h-24 mx-auto md:mx-0 rounded-full object-cover">
                @else
                    <div class="w-24 h-24 mx-auto md:mx-0 flex items-center justify-center rounded-full bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-300">
                        N/A
                    </div>
                @endif

                <div>
                    <h2 class="text-xl font-semibold">{{ $job->company->name ?? 'Nincs megadva' }}</h2>
                    <p class="text-gray-600 dark:text-gray-400">{{ $job->company->address ?? 'Cím nincs megadva' }}</p>
                    <p class="text-gray-600 dark:text-gray-400">{{ $job->company->email ?? 'Email nincs megadva' }}</p>
                    <p class="text-gray-600 dark:text-gray-400">{{ $job->company->phone ?? 'Telefon nincs megadva' }}</p>
                </div>
            </div>

            {{-- Jobb oldal: állásadatok --}}
            <div class="space-y-3">
                <h1 class="text-2xl font-bold">{{ $job->title }}</h1>
                <p>
                    <strong>Fizetés:</strong>
                    {{ number_format($job->salary, 0, ',', ' ') }} Ft /
                    {{ $job->salary_type === 'órabér' ? 'óra' : 'hó' }}
                </p>
                <p><strong>Helyszín:</strong> {{ $job->location ?? 'Nincs megadva' }}</p>
                <p><strong>Típus:</strong> {{ $job->type ?? 'Nincs megadva' }}</p>
            </div>
        </div>

        {{-- Leírás --}}
        @if(!empty($job->description))
            <div class="mt-10">
                <h2 class="text-xl font-semibold mb-2">Leírás</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">
                    {{ $job->description }}
                </p>
            </div>
        @endif

        {{-- Jelentkezés gomb --}}
        <div class="mt-8 text-center">
            @auth('company')
                @if(auth('company')->user()->id === $job->company_id)
                    <a href="{{ route('jobs.edit', $job->id) }}" class="btn">
                        Szerkesztés
                    </a>
                @else
                    <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-5 py-2 rounded-md shadow text-center">
                        Cégként nem tudsz jelentkezni állásra.
                    </div>
                @endif
            @else
                @if($alreadyApplied ?? false)
                    <span class="inline-block px-6 py-2 rounded-md bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-100 font-medium">
                        Jelentkezett
                    </span>
                @else
                    <form action="{{ route('jobs.apply', $job) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn">
                            Jelentkezés
                        </button>
                    </form>
                @endif
            @endauth
        </div>
    </div>
</x-app-layout>
