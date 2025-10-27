@if ($paginator->lastPage() > 1)
    <div class="flex justify-center mt-12 mb-20 space-x-2">
        {{-- Előző oldal --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-gray-400 cursor-not-allowed">‹</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 rounded-md bg-white dark:bg-[#2b2b2b] border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">‹</a>
        @endif

        {{-- Oldalszámok --}}
        @php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();
            $start = max(1, $current - 2);
            $end = min($last, $start + 4);
        @endphp

        {{-- Első oldalak és „...” --}}
        @if ($start > 1)
            <a href="{{ $paginator->url(1) }}" class="px-4 py-2 rounded-md bg-white dark:bg-[#2b2b2b] border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">1</a>
            @if ($start > 2)
                <span class="px-3 py-2 text-gray-500">...</span>
            @endif
        @endif

        {{-- Középső oldalak --}}
        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $current)
                <span class="px-4 py-2 rounded-md bg-gray-300 dark:bg-gray-600 text-gray-900 dark:text-gray-100">{{ $i }}</span>
            @else
                <a href="{{ $paginator->url($i) }}" class="px-4 py-2 rounded-md bg-white dark:bg-[#2b2b2b] border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">{{ $i }}</a>
            @endif
        @endfor

        {{-- „...” és utolsó oldal --}}
        @if ($end < $last)
            @if ($end < $last - 1)
                <span class="px-3 py-2 text-gray-500">...</span>
            @endif
            <a href="{{ $paginator->url($last) }}" class="px-4 py-2 rounded-md bg-white dark:bg-[#2b2b2b] border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">{{ $last }}</a>
        @endif

        {{-- Következő oldal --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 rounded-md bg-white dark:bg-[#2b2b2b] border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">›</a>
        @else
            <span class="px-4 py-2 text-gray-400 cursor-not-allowed">›</span>
        @endif
    </div>
@endif