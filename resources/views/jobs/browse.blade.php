<x-app-layout>
            
            <!-- Munkamenet üzenetek -->
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

<!-- Szűrődoboz: csak akkor látható, ha a navbarból megnyitod -->
<div id="filters-box"
     style="display:@if(request()->filled('location') || request()->filled('type') || request()->filled('min_salary') || request()->filled('max_salary')) block @else none @endif;">

    <form method="GET" action="{{ route('jobs.browse') }}">
        <div class="flex flex-wrap items-end justify-center gap-4 mb-6">

            {{-- Helyszín --}}
            <div class="flex flex-col">
                <input type="text" name="location" value="{{ request('location') }}" placeholder="Helyszín" 
                       class="input w-44 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400">
            </div>

            {{-- Pozíció --}}
            <div class="flex flex-col">
                <input type="text" name="position" value="{{ request('position') }}" placeholder="Pozíció"
                       class="input w-44 text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400">
            </div>

            {{-- Típus --}}
            <div class="flex flex-col">
                <select name="type" class="input w-44" >
                    <option value="" disabled selected>Típus</option>
                    <option value="Teljes munkaidő" {{ request('type') == 'Teljes munkaidő' ? 'selected' : '' }}>Teljes munkaidő</option>
                    <option value="Rész munkaidő" {{ request('type') == 'Rész munkaidő' ? 'selected' : '' }}>Rész munkaidő</option>
                    <option value="Gyakornok" {{ request('type') == 'Gyakornok' ? 'selected' : '' }}>Gyakornok</option>
                    <option value="Hibrid" {{ request('type') == 'Hibrid' ? 'selected' : '' }}>Hibrid</option>
                </select>
            </div>

            {{-- Min fizetés --}}
            <div class="flex flex-col">
                <div class="flex items-center gap-2">
                    <input type="number" id="min_salary_input" name="min_salary"
                           min="0" max="2000000" step="10000"
                           value="{{ request('min_salary', 0) }}"
                           placeholder="Min fizetés"
                           class="input w-28 text-center">
                    <span class="text-gray-700 dark:text-gray-200 text-sm">Ft</span>
                </div>
            </div>

            {{-- Max fizetés --}}
            <div class="flex flex-col">
                <div class="flex items-center gap-2">
                    <input type="number" id="max_salary_input" name="max_salary"
                           min="0" max="2000000" step="10000"
                           value="{{ request('max_salary', 2000000) }}"
                           placeholder="Max fizetés"
                           class="input w-28 text-center">
                    <span class="text-gray-700 dark:text-gray-200 text-sm">Ft</span>
                </div>
            </div>

            {{-- Gombok --}}
            <div class="flex gap-2">
                <button type="submit" class="btn">Szűrés</button>
                <a href="{{ route('jobs.browse') }}" class="btn">Törlés</a>
            </div>

        </div>
    </form>
</div>

            <!-- Állások -->
                @if(isset($jobs) && count($jobs) > 0)
                    <div class="job-cards-grid" style="display: grid; grid-template-columns: repeat(auto-fill,minmax(300px,1fr)); gap: 1rem; margin-top: 1rem;">
                        @foreach($jobs as $job)
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
                                    <a href="{{ route('jobs.show', $job->id) }}" 
                                       class="btn">
                                       Részletek
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-8 mb-16">
                        <x-pagination :paginator="$jobs" />  
                    </div>                 
                @else
                    Jelenleg nincs elérhető állásajánlat.
                @endif

<script>
    const toggleBtn = document.getElementById('toggle-filters');
    const filtersBox = document.getElementById('filters-box');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            if (filtersBox.style.display === 'none' || filtersBox.style.display === '') {
                filtersBox.style.display = 'block';
            } else {
                filtersBox.style.display = 'none';
            }
        });
    }
</script>
<script>
    const minSlider = document.getElementById('min_salary');
    const maxSlider = document.getElementById('max_salary');
    const minValue = document.getElementById('min_salary_value');
    const maxValue = document.getElementById('max_salary_value');

    if (minSlider && maxSlider) {
        minSlider.addEventListener('input', () => minValue.textContent = minSlider.value);
        maxSlider.addEventListener('input', () => maxValue.textContent = maxSlider.value);
    }
</script>
<script>
    const linkSliders = (sliderId, inputId) => {
        const slider = document.getElementById(sliderId);
        const input = document.getElementById(inputId);
        if (slider && input) {
            slider.addEventListener('input', () => input.value = slider.value);
            input.addEventListener('input', () => slider.value = input.value);
        }
    };
    linkSliders('min_salary', 'min_salary_input');
    linkSliders('max_salary', 'max_salary_input');
</script>
</x-app-layout>