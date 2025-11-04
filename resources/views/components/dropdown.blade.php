@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'bg-[#3c3e43] text-white text-left'])

@php
    switch ($align) {
        case 'left':
            $alignmentClasses = 'origin-top-left start-0';
            break;
        case 'top':
            $alignmentClasses = 'origin-top';
            break;
        default:
            $alignmentClasses = 'origin-top-right end-0';
            break;
    }

    $width = match ($width) {
        '48' => 'w-auto min-w-[10rem]',
        default => 'w-auto min-w-[10rem]',
    };
@endphp

<div class="relative">
    <div x-data="{ open: false }" @click.away="open = false" class="relative">
        <div @click="open = !open">
            <div class="dropdown-trigger rounded-md transition-colors duration-150 cursor-pointer">
                {{ $trigger }}
            </div>
        </div>

        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }}"
            style="display: none;"
        >
            <div class="rounded-md overflow-hidden shadow-lg border border-[#6b6d72] dark:border-[#71747b] {{ $contentClasses }}">
                <div class="flex flex-col">
                    {{ $content }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Globális dropdown link stílus --}}
@once
    <style>
        .dropdown-menu a {
            display: block;
            padding: 0.6rem 1rem;
            font-size: 0.95rem;
            text-align: left;
            color: #ffffff;
            background-color: #3c3e43;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        .dropdown-menu a:hover {
            background-color: #4b4d52;
            color: #fff;
        }
        .dropdown-trigger:hover {
            background-color: #4b4d52;
            transition: background-color 0.2s ease;
        }
    </style>
@endonce