<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full"
      x-data="{ darkMode: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches) }"
      x-init="$watch('darkMode', value => localStorage.setItem('theme', value ? 'dark' : 'light'))"
      x-cloak>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body :style="darkMode 
            ? 'background-color: #1f2937; color: rgb(230,231,235); transition: background-color 300ms, color 300ms;' 
            : 'background-color: rgb(255,255,255); color: rgb(33,41,54); transition: background-color 300ms, color 300ms;'">
        <div class="min-h-full flex flex-col"
             :style="darkMode 
                ? 'background-color: rgb(33,41,54); color: rgb(230,231,235); transition: background-color 300ms, color 300ms;' 
                : 'background-color: rgb(255,255,255); color: rgb(33,41,54); transition: background-color 300ms, color 300ms;'">

            @include('layouts.navigation')

            @isset($header)
                <header :style="darkMode 
                        ? 'background-color: rgb(33,41,54); color: rgb(230,231,235); box-shadow: 0 1px 2px rgba(0,0,0,0.05); transition: background-color 300ms, color 300ms;' 
                        : 'background-color: rgb(255,255,255); color: rgb(33,41,54); box-shadow: 0 1px 2px rgba(0,0,0,0.05); transition: background-color 300ms, color 300ms;'">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1 flex justify-center min-h-screen rounded-lg"
                  :style="darkMode 
                    ? 'background-color: #4a5a75; color: rgb(230,231,235); transition: background-color 300ms, color 300ms;' 
                    : 'background-color: #f3f4f6; color: rgb(33,41,54); transition: background-color 300ms, color 300ms;'">
                {{ $slot }}
            </main>
        </div>
        <script>
            (function() {
                window.addEventListener('load', function() {
                    const scrollPos = sessionStorage.getItem('scrollPosition');
                    if (scrollPos) {
                        const pos = JSON.parse(scrollPos);
                        window.scrollTo(pos.x, pos.y);
                        sessionStorage.removeItem('scrollPosition');
                    }
                });
                document.addEventListener('submit', function(event) {
                    sessionStorage.setItem('scrollPosition', JSON.stringify({ x: window.scrollX, y: window.scrollY }));
                }, true);
            })();
        </script>
        @include('profile.partials.chatbot')
    </body>
</html>