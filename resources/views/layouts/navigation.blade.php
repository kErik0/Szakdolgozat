@php
    $user = Auth::guard('web')->check() ? Auth::guard('web')->user() : (Auth::guard('company')->check() ? Auth::guard('company')->user() : null);
@endphp
<nav class="navbar flex justify-between items-center px-12 py-3 bg-nav-dark text-white">    <div class="nav-left">
        <a href="{{ route('jobs.browse') }}" class="{{ request()->routeIs('jobs.browse') ? 'active' : '' }}">
            Főoldal
        </a>

        <a href="{{ route('dashboard-company') }}" class="{{ request()->routeIs('dashboard-company') ? 'active' : '' }}">
            Cégek
        </a>
    </div>

    @if (request()->routeIs('jobs.browse') || request()->routeIs('dashboard-company'))
        <div class="nav-center">
            <form method="GET" action="{{ request()->is('dashboard-company*') || request()->is('companies*') ? route('dashboard-company') : route('jobs.browse') }}">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Keresés..." 
                    class="px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#3c3e43] text-gray-800 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus-visible:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-0 focus:border-gray-500 transition"
                >
            </form>
            <button type="button" id="toggle-filters" class="btn">Szűrők</button>
        </div>
    @endif

    <div class="nav-right">
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

        @if($user)
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center justify-start gap-1 pl-2 pr-3 py-2 rounded text-white hover:bg-[#4b4d52] focus:outline-none focus:ring-0 transition" style="min-width: 120px;">
                        <div class="whitespace-nowrap overflow-hidden text-ellipsis text-left">{{ $user->name }}</div>
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
            <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">
                Bejelentkezés
            </a>
            <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">
                Regisztráció
            </a>
        @endif
    </div>
</nav>
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
});
</script>