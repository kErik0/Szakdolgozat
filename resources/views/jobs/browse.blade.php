<x-app-layout>
            
            <!-- Munkamenet üzenetek -->
            @if (session('success'))
                {{ session('success') }}
            @endif
            @if (session('error'))
                {{ session('error') }}
            @endif

<!-- Szűrődoboz: csak akkor látható, ha a navbarból megnyitod -->
<div id="filters-box"
     style="display:@if(request()->filled('location') || request()->filled('type') || request()->filled('min_salary') || request()->filled('max_salary')) block @else none @endif;"
     class="bg-white dark:bg-[#2b2b2b] p-6 rounded-lg shadow-sm mb-8">

    <form method="GET" action="{{ route('jobs.browse') }}">
        <div class="flex flex-wrap gap-3 items-center justify-center mb-4">
            <input type="text" name="location" value="{{ request('location') }}" placeholder="Helyszín" class="input w-44" />

            <select name="type" class="input w-44">
                <option value="">Típus</option>
                <option value="Teljes munkaidő" {{ request('type') == 'Teljes munkaidő' ? 'selected' : '' }}>Teljes munkaidő</option>
                <option value="Rész munkaidő" {{ request('type') == 'Rész munkaidő' ? 'selected' : '' }}>Rész munkaidő</option>
                <option value="Gyakornok" {{ request('type') == 'Gyakornok' ? 'selected' : '' }}>Gyakornok</option>
                <option value="Hibrid" {{ request('type') == 'Hibrid' ? 'selected' : '' }}>Hibrid</option>
            </select>

            <div class="flex flex-col items-center gap-3 w-full">
                <label for="min_salary" class="text-gray-700 dark:text-gray-200">
                    Min fizetés:
                </label>
                <div class="flex items-center gap-3">
                    <input type="range" id="min_salary" name="min_salary"
                           min="0" max="2000000" step="10000"
                           value="{{ request('min_salary', 0) }}"
                           class="w-56 accent-gray-900 dark:accent-gray-100">
                    <input type="number" id="min_salary_input"
                           min="0" max="2000000" step="10000"
                           value="{{ request('min_salary', 0) }}"
                           class="input w-24 text-center">
                    <span class="text-gray-700 dark:text-gray-200">Ft</span>
                </div>
            </div>

            <div class="flex flex-col items-center gap-3 w-full">
                <label for="max_salary" class="text-gray-700 dark:text-gray-200">
                    Max fizetés:
                </label>
                <div class="flex items-center gap-3">
                    <input type="range" id="max_salary" name="max_salary"
                           min="0" max="2000000" step="10000"
                           value="{{ request('max_salary', 2000000) }}"
                           class="w-56 accent-gray-900 dark:accent-gray-100">
                    <input type="number" id="max_salary_input"
                           min="0" max="2000000" step="10000"
                           value="{{ request('max_salary', 2000000) }}"
                           class="input w-24 text-center">
                    <span class="text-gray-700 dark:text-gray-200">Ft</span>
                </div>
            </div>

            <button type="submit" class="btn">Szűrés</button>
            <a href="{{ route('jobs.browse') }}" class="btn">Törlés</a>
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
                                <p class="text-center text-gray-600 dark:text-gray-300">{{ $job->location }}</p>
                                <p class="text-center text-gray-600 dark:text-gray-300">{{ $job->type }}</p>
                                <p class="text-center text-gray-800 dark:text-gray-200 font-medium mt-2">{{ number_format($job->salary, 0, ',', ' ') }} Ft</p>

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