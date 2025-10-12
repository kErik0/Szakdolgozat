<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-white mb-6">Üdv, {{ $user->name }}!</p>

                <h3 class="text-white text-lg font-semibold mb-2">Felhasználók kezelése</h3>
                <table class="min-w-full bg-gray-800 text-white mb-6">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-700 text-left">Név</th>
                            <th class="py-2 px-4 border-b border-gray-700 text-left">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $userItem)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-700">{{ $userItem->name }}</td>
                                <td class="py-2 px-4 border-b border-gray-700">{{ $userItem->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3 class="text-white text-lg font-semibold mb-2">Cégek kezelése</h3>
                <table class="min-w-full bg-gray-800 text-white mb-6">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-700 text-left">Cégnév</th>
                            <th class="py-2 px-4 border-b border-gray-700 text-left">Leírás</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-700">{{ $company->name }}</td>
                                <td class="py-2 px-4 border-b border-gray-700">{{ $company->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3 class="text-white text-lg font-semibold mb-2">Álláshirdetések</h3>
                <table class="min-w-full bg-gray-800 text-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-700 text-left">Pozíció</th>
                            <th class="py-2 px-4 border-b border-gray-700 text-left">Leírás</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-700">{{ $job->title }}</td>
                                <td class="py-2 px-4 border-b border-gray-700">{{ $job->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>