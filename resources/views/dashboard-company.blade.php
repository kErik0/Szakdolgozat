<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Főoldal - Cég
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <div style="color: yellow; background: black;">CÉG VAGY TE!</div>
                    <p class="text-white">Teszt szöveg</p>
                    <h1 class="mt-2 text-2xl font-semibold">Üdvözlünk, {{ Auth::user()->name }}</h1>
                    <p class="mt-1">Jelenlegi szerepkör: {{ Auth::user()->role }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
