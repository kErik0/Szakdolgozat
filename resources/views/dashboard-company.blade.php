<x-app-layout>
    @if(isset($companies) && count($companies) > 0)
        <div class="job-cards-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1rem; margin-top: 1rem;">
            @foreach($companies as $company)
                @php
                    $profileImage = $company->logo;
                @endphp

                <div class="job-card bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6 transition-transform transform hover:scale-105 hover:shadow-lg duration-300">
                    @if($profileImage && file_exists(public_path($profileImage)))
                        <div class="flex justify-center mb-4">
                            <img src="{{ asset($profileImage) }}" alt="{{ $company->name }}" class="w-20 h-20 object-cover rounded-full">
                        </div>
                    @else
                        <div class="w-20 h-20 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-full mx-auto mb-4 text-gray-500 dark:text-gray-300">
                            N/A
                        </div>
                    @endif
                    <h3 class="text-lg font-semibold text-center mb-2 text-gray-900 dark:text-gray-100">{{ $company->name }}</h3>
                    <p class="text-center text-gray-600 dark:text-gray-300">📍 {{ $company->address ?? 'Nincs megadva' }}</p>
                    <p class="text-center text-gray-600 dark:text-gray-300">📧 {{ $company->email ?? 'Nincs megadva' }}</p>
                    <p class="text-center text-gray-600 dark:text-gray-300">📞 {{ $company->phone ?? 'Nincs megadva' }}</p>
                    <div class="text-center mt-4">
                        <a href="{{ route('companies', $company->id) }}" class="btn">
                            Részletek
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8 mb-16">
            <x-pagination :paginator="$companies" />  
        </div>  
    @else
        Jelenleg nincs elérhető cég.
    @endif
</x-app-layout>