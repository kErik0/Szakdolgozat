@php
    $user = Auth::guard('web')->check() ? Auth::guard('web')->user() : (Auth::guard('company')->check() ? Auth::guard('company')->user() : null);
@endphp
<nav class="navbar flex justify-between items-center px-12 py-3 bg-nav-dark text-white">    <div class="nav-left flex items-center gap-4">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
            Főoldal
        </a>
        <a href="{{ route('jobs.browse') }}" class="{{ request()->routeIs('jobs.browse') ? 'active' : '' }}">
            Állások
        </a>

        <a href="{{ route('dashboard-company') }}" class="{{ request()->routeIs('dashboard-company') ? 'active' : '' }}">
            Cégek
        </a>
    </div>

    @if (request()->routeIs('jobs.browse') || request()->routeIs('dashboard-company'))
        <div class="nav-center search-desktop flex items-center gap-2">
            <form method="GET" action="{{ request()->routeIs('dashboard-company') ? route('dashboard-company') : route('jobs.browse') }}">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Keresés..." 
                    class="px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#3c3e43] text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus-visible:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-0 focus:border-gray-500 transition"
                >
            </form>

            @if(request()->routeIs('jobs.browse'))
                <button type="button" id="toggle-filters" class="btn">Szűrők</button>
            @endif
        </div>
    @endif

    <div class="nav-right flex items-center gap-2">
        @if (request()->routeIs('jobs.browse') || request()->routeIs('dashboard-company'))
        <button id="mobile-search-btn" class="md:hidden lg:hidden block w-10 h-10 flex items-center justify-center rounded-full hover:bg-[#4b4d52] transition">
            <svg xmlns="http://www.w3.org/2000/svg"
                 fill="currentColor"
                 viewBox="0 0 20 20"
                 class="h-5 w-5 text-white opacity-90">
                <path fill-rule="evenodd"
                      d="M12.9 14.32a8 8 0 111.414-1.414l4.387 4.387a1 1 0 01-1.414 1.414l-4.387-4.387zM14 8a6 6 0 11-12 0 6 6 0 0112 0z"
                      clip-rule="evenodd"/>
            </svg>
        </button>
        @endif
        <button aria-label="Toggle dark mode" id="theme-toggle">
            <!-- Nap ikon (világos mód) -->
            <svg id="sun-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke="white">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 2v2m0 16v2m8-10h2M2 12H4m15.364-7.364l1.414 1.414M4.222 19.778l1.414-1.414M19.778 19.778l-1.414-1.414M4.222 4.222l1.414 1.414M12 6a6 6 0 100 12A6 6 0 0012 6z" />
            </svg>

            <!-- Hold ikon (sötét mód) -->
            <svg id="moon-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke="white" style="opacity: 0;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" />
            </svg>
        </button>
        <button id="mobile-menu-toggle" class="md:hidden lg:hidden block w-10 h-10 flex items-center justify-center rounded-full hover:bg-[#4b4d52] transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
            </svg>
        </button>

        @if($user)
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="dropdown-trigger flex items-center justify-start gap-1 pl-2 pr-3 py-2 rounded-md text-white bg-transparent hover:bg-[#4b4d52] hover:border hover:border-[#6b6d72] focus:outline-none focus:ring-0 transition-all duration-150" style="min-width: 120px;">
                        <div class="whitespace-nowrap overflow-hidden text-ellipsis text-left">{{ $user->name }}</div>
                        <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            class="h-4 w-4 opacity-80 transition-transform duration-150" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke="currentColor"
                            :class="{ 'rotate-180': open }"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">{{ __('Profil') }}</x-dropdown-link>
                    @if($user->role === 'company')
                        <x-dropdown-link :href="route('jobs.index')">{{ __('Saját hirdetéseim') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('jobs.create')">{{ __('Új álláshirdetés') }}</x-dropdown-link>
                    @elseif($user->role === 'user')
                        <x-dropdown-link :href="url('/my-applications')">{{ __('Saját jelentkezéseim') }}</x-dropdown-link>
                    @endif
                    <form method="POST" action="{{ $user && $user->role === 'company' ? route('company.logout') : route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="$user && $user->role === 'company' ? route('company.logout') : route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Kijelentkezés') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        @else
            <a href="{{ route('login') }}" class="hidden lg:block {{ request()->routeIs('login') ? 'active' : '' }}">
                Bejelentkezés
            </a>
            <a href="{{ route('register') }}" class="hidden lg:block {{ request()->routeIs('register') ? 'active' : '' }}">
                Regisztráció
            </a>
        @endif
    </div>
</nav>
<div id="mobile-menu" class="lg:hidden fixed top-16 right-4 rounded-md shadow-lg hidden z-40 w-auto min-w-[10rem]">
    <div class="rounded-md overflow-hidden shadow-lg border border-[#6b6d72] dark:border-[#71747b] bg-[#3c3e43] text-white flex flex-col p-0">
        @if($user)
            <a href="{{ route('profile.edit') }}" class="block py-2 px-4 text-left hover:bg-[#4b4d52] transition">Profil</a>

            @if($user->role === 'company')
                <a href="{{ route('jobs.index') }}" class="block py-2 px-4 text-left hover:bg-[#4b4d52] transition">Saját hirdetéseim</a>
                <a href="{{ route('jobs.create') }}" class="block py-2 px-4 text-left hover:bg-[#4b4d52] transition">Új álláshirdetés</a>
            @elseif($user->role === 'user')
                <a href="{{ url('/my-applications') }}" class="block py-2 px-4 text-left hover:bg-[#4b4d52] transition">Saját jelentkezéseim</a>
            @endif

            <form id="mobile-logout-form" method="POST" action="{{ $user->role === 'company' ? route('company.logout') : route('logout') }}" class="hidden">
                @csrf
            </form>

            <a href="#"
               onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();"
               class="block w-full text-left py-2 px-4 hover:bg-[#4b4d52] transition text-white">
                Kijelentkezés
            </a>
        @else
            <a href="{{ route('login') }}" class="block py-2 px-4 text-left hover:bg-[#4b4d52] transition">Bejelentkezés</a>
            <a href="{{ route('register') }}" class="block py-2 px-4 text-left hover:bg-[#4b4d52] transition">Regisztráció</a>
        @endif
    </div>
</div>
<div id="mobile-search-overlay" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm z-50 hidden pointer-events-none">
    <div class="absolute top-0 left-0 right-0 bg-nav-dark text-white p-4 flex flex-col gap-3 shadow-lg">
        <form method="GET" action="{{ request()->routeIs('dashboard-company') ? route('dashboard-company') : route('jobs.browse') }}">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="currentColor"
                     viewBox="0 0 20 20"
                     class="h-6 w-6 text-white opacity-90">
                    <path fill-rule="evenodd"
                          d="M12.9 14.32a8 8 0 111.414-1.414l4.387 4.387a1 1 0 01-1.414 1.414l-4.387-4.387zM14 8a6 6 0 11-12 0 6 6 0 0112 0z"
                          clip-rule="evenodd"/>
                </svg>
                <input id="mobile-search-input"
                       name="search"
                       type="text"
                       placeholder="Keresés..."
                       class="flex-1 px-3 py-2 rounded-md bg-white text-gray-900 placeholder-gray-500 focus:outline-none">
                <button type="button" id="mobile-search-close" class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </form>
        @if(request()->routeIs('jobs.browse'))
            <button id="mobile-filters-btn" class="btn w-full">Szűrők</button>
        @endif
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    const sunIcon = document.getElementById('sun-icon');
    const moonIcon = document.getElementById('moon-icon');

    // Alapértelmezett állapot beállítása
    const isDark = document.documentElement.classList.contains('dark');
    sunIcon.style.opacity = isDark ? '0' : '1';
    moonIcon.style.opacity = isDark ? '1' : '0';

    // Fix méret és pozíció, ne mozduljon el
    Object.assign(themeToggle.style, {
        width: '40px',
        height: '40px',
        display: 'inline-flex',
        alignItems: 'center',
        justifyContent: 'center',
        transition: 'none'
    });

    // Kattintás esemény
    themeToggle.addEventListener('click', () => {
        const darkMode = document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', darkMode ? 'dark' : 'light');
        sunIcon.style.opacity = darkMode ? '0' : '1';
        moonIcon.style.opacity = darkMode ? '1' : '0';
    });

    const mobileSearchBtn = document.getElementById('mobile-search-btn');
    const mobileSearchOverlay = document.getElementById('mobile-search-overlay');
    const mobileSearchClose = document.getElementById('mobile-search-close');
    const mobileSearchInput = document.getElementById('mobile-search-input');
    const mobileFiltersBtn = document.getElementById('mobile-filters-btn');
    const desktopFiltersBtn = document.getElementById('toggle-filters');

    mobileSearchBtn?.addEventListener('click', () => {
        mobileSearchOverlay.classList.remove('hidden');
        mobileSearchOverlay.classList.remove('pointer-events-none');
        mobileSearchOverlay.classList.add('pointer-events-auto');
        setTimeout(() => mobileSearchInput.focus(), 100);
    });

    mobileSearchClose?.addEventListener('click', () => {
        mobileSearchOverlay.classList.add('hidden');
        mobileSearchOverlay.classList.remove('pointer-events-auto');
        mobileSearchOverlay.classList.add('pointer-events-none');
    });

    mobileFiltersBtn?.addEventListener('click', () => {
        mobileSearchOverlay.classList.add('hidden');
        mobileSearchOverlay.classList.remove('pointer-events-auto');
        mobileSearchOverlay.classList.add('pointer-events-none');

        desktopFiltersBtn?.click();
    });
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuToggle?.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Ha átméretezed az ablakot desktopról mobilra, minden dropdown és mobilmenü záródjon be
    window.addEventListener('resize', () => {
        if (window.innerWidth < 1024) {

            // Desktop dropdownok bezárása (kattintással, ami Alpine-nak is jó)
            document.querySelectorAll('.dropdown-trigger').forEach(btn => {
                const parent = btn.closest('[x-data]');
                if (parent && parent.__x && parent.__x.$data.open) {
                    btn.click();
                }
            });

            // Mobil menü bezárása
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenu) mobileMenu.classList.add('hidden');

            // Mobil kereső overlay bezárása
            const mobileSearchOverlay = document.getElementById('mobile-search-overlay');
            if (mobileSearchOverlay) {
                mobileSearchOverlay.classList.add('hidden');
                mobileSearchOverlay.classList.add('pointer-events-none');
                mobileSearchOverlay.classList.remove('pointer-events-auto');
            }
        }
    });
});
</script>