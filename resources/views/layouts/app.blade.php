<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data
      x-bind:class="{ 'dark': localStorage.theme === 'dark' }"
      class="transition-none">
<script>
(function(){
  try {
    var theme = localStorage.getItem('theme');
    if (theme === 'dark' || (!theme && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  } catch (e) {
    /* ignore */
  }
})();
</script>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    </head>
<body class="bg-[#f9f9f7] dark:bg-[#1f1f1f] text-gray-900 dark:text-gray-100 min-h-screen transition-colors duration-300">
    @include('layouts.navigation')
    @isset($header)
        <header class="max-w-7xl mx-auto mt-6 p-4 bg-white dark:bg-[#2b2b2b] rounded-lg shadow-sm transition-colors duration-300">
            <div>
                {{ $header }}
            </div>
        </header>
    @endisset
    <main class="mt-20 mb-20 max-w-7xl mx-auto bg-white dark:bg-[#2b2b2b] rounded-lg shadow-sm p-6 transition-colors duration-300">
        {{ $slot }}
    </main>
    @include('profile.partials.chatbot')
</body>
</html>