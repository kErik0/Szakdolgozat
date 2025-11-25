<x-app-layout>
    <div class="max-w-4xl mx-auto mt-12 mb-20 text-text-light dark:text-text-dark">
        <div class="flex flex-col items-center text-center md:text-left md:flex-row gap-12">
            @if($company->logo && file_exists(public_path($company->logo)))
                <img src="{{ asset($company->logo) }}" alt="{{ $company->name }}" class="w-32 h-32 rounded-full object-cover mx-auto md:mx-0">
            @else
                <div class="w-32 h-32 flex items-center justify-center rounded-full bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-300 mx-auto md:mx-0">
                    N/A
                </div>
            @endif
            <div class="flex-1">
                <h1 class="text-4xl font-extrabold mb-6 text-gray-900 dark:text-gray-100">{{ $company->name }}</h1>
                <p class="text-gray-700 dark:text-gray-300 mb-3">📍 {{ $company->address ?? 'Nincs megadva' }}</p>
                <p class="text-gray-700 dark:text-gray-300 mb-3">💼 {{ $company->tax_number ?? 'Nincs megadva' }}</p>
                <p class="text-gray-700 dark:text-gray-300 mb-3">📞 {{ $company->phone ?? 'Nincs megadva' }}</p>
                <p class="text-gray-700 dark:text-gray-300 mb-3">✉️ {{ $company->email ?? 'Nincs megadva' }}</p>
                <p class="text-gray-700 dark:text-gray-300 mb-3">🌐 <a href="{{ $company->website }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $company->website ?? 'Nincs megadva' }}</a></p>
            </div>
        </div>
        <hr class="my-8 border-gray-300 dark:border-gray-700">
        <div class="mt-10">
            <h2 class="text-xl font-semibold mb-2">Cég bemutatkozása</h2>
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">
                {{ !empty($company->description) ? $company->description : 'Nincs még bemutatkozás.' }}
            </p>
        </div>
    </div>
</x-app-layout>
