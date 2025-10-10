<div class="min-h-screen bg-gray-900 text-white py-8 px-4">
    <h1 class="text-3xl font-bold mb-8">Jelentkezéseim</h1>
    @if($applications->isEmpty())
        <div class="bg-gray-800 text-center py-8 rounded-lg shadow">
            Még nem jelentkeztél egy állásra sem.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-800 rounded-lg shadow">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">Állás címe</th>
                        <th class="px-6 py-3 text-left font-semibold">Hely</th>
                        <th class="px-6 py-3 text-left font-semibold">Cég neve</th>
                        <th class="px-6 py-3 text-left font-semibold">Státusz</th>
                        <th class="px-6 py-3 text-left font-semibold">CV</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $application)
                        <tr class="border-b border-gray-700 last:border-b-0">
                            <td class="px-6 py-4">{{ $application->job->title }}</td>
                            <td class="px-6 py-4">{{ $application->job->location }}</td>
                            <td class="px-6 py-4">{{ $application->job->company->name }}</td>
                            <td class="px-6 py-4">
                                @switch($application->status)
                                    @case('pending')
                                        Függőben
                                        @break
                                    @case('accepted')
                                        Elfogadva
                                        @break
                                    @case('rejected')
                                        Elutasítva
                                        @break
                                    @default
                                        {{ $application->status }}
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>