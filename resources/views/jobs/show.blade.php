<x-app-layout>
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
                <p><strong>Fizetés:</strong> {{ number_format($job->salary, 0, ',', ' ') }} Ft</p>
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
        </div>
    </div>
</x-app-layout>
