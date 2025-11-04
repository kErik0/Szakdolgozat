<x-app-layout>
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
  <div class="min-h-screen">
    <div class="max-w-6xl mx-auto px-6 mt-8">
      <h1 class="text-3xl font-bold text-center mb-8 text-gray-900 dark:text-gray-100">Jelentkezők</h1>

      @if($applications->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
          @foreach($applications as $application)
            <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm transition-transform transform hover:scale-105 hover:shadow-lg duration-300 flex flex-col justify-between h-full">
              <div>
                <div class="flex justify-between items-center mb-3">
                  <div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $application->user->name }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $application->user->email }}</p>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $application->user->phone ?? 'Nincs megadva telefonszám' }}</p>
                  </div>
                  <div class="ml-3">
                    @if($application->user->resume)
                      <a href="{{ asset('storage/cvs/' . $application->user->resume) }}" target="_blank"
                         class="bg-gray-900 dark:bg-gray-100 dark:text-gray-900 text-white px-4 py-1.5 rounded-md text-sm hover:bg-gray-700 dark:hover:bg-gray-300 transition">
                        Önéletrajz
                      </a>
                    @else
                      <button disabled class="bg-gray-400 text-white px-4 py-1.5 rounded-md text-sm cursor-not-allowed">Önéletrajz</button>
                    @endif
                  </div>
                </div>

                <div class="text-center mb-4">
                  @if($application->status === 'pending')
                    <span class="bg-yellow-100 text-yellow-800 text-sm font-medium px-3 py-1 rounded-full">Függőben</span>
                  @elseif($application->status === 'accepted')
                    <span class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">Elfogadva</span>
                  @elseif($application->status === 'rejected')
                    <span class="bg-red-100 text-red-800 text-sm font-medium px-3 py-1 rounded-full">Elutasítva</span>
                  @endif
                </div>
              </div>

              <div class="flex flex-col items-center gap-3 mt-4">
                <div class="flex justify-center gap-3">
                  @if($application->status === 'pending')
                    <form action="{{ route('applications.accept', $application->id) }}" method="POST">
                      @csrf
                      <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm shadow transition">Elfogad</button>
                    </form>
                    <form action="{{ route('applications.reject', $application->id) }}" method="POST">
                      @csrf
                      <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm shadow transition">Elutasít</button>
                    </form>
                  @endif
                </div>

                @if($application->status === 'accepted' || $application->status === 'rejected')
                  <form action="{{ route('applications.destroyCompany', $application->id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-gray-800 dark:bg-gray-700 hover:bg-gray-900 dark:hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm shadow transition">
                      Törlés
                    </button>
                  </form>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      @else
        <p class="text-center text-gray-600 dark:text-gray-300 mt-10">Nincsenek jelentkezések ehhez az álláshoz.</p>
      @endif
    </div>
  </div>
</x-app-layout>