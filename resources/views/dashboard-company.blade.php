<x-app-layout>
    <main class="flex-1 flex justify-center min-h-screen"
          :style="darkMode 
            ? 'background-color: #1f2937; color: rgb(230,231,235); transition: background-color 300ms, color 300ms;' 
            : 'background-color: #ffffff; color: rgb(33,41,54); transition: background-color 300ms, color 300ms;'">
        <div class="w-full max-w-7xl p-6 rounded-lg"
             :style="darkMode 
                ? 'background-color: #3b4b63; color: rgb(230,231,235); border-color: #475569; transition: background-color 300ms, color 300ms, border-color 300ms;' 
                : 'background-color: #f3f4f6; color: rgb(33,41,54); border-color: #e5e7eb; transition: background-color 300ms, color 300ms, border-color 300ms;'">
            
            <!-- Felhasználói adatok blokk -->
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Üdvözlünk, {{ Auth::user()->name }}</h2>
                <p class="text-gray-700 dark:text-gray-200"><strong>Szerepkör:</strong> {{ Auth::user()->role }}</p>
            </div>

        </div>
    </main>
</x-app-layout>