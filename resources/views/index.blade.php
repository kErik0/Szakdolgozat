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

  <div class="max-w-4xl mx-auto mt-10 text-center text-gray-900 dark:text-gray-100 text-2xl font-semibold">
      🎉 Ez egy teszt főoldal tartalom. Itt majd jön az új dizájn.
  </div>
</x-app-layout>