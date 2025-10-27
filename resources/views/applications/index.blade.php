<x-app-layout>
    @if($applications->isEmpty())
        <div>
            Még nem jelentkeztél egy állásra sem.
        </div>
    @else
        <table>
            <thead>
                <tr>
                    <th>Állás címe</th>
                    <th>Hely</th>
                    <th>Cég neve</th>
                    <th>Státusz</th>
                    <th>CV</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $application)
                    <tr>
                        <td>{{ $application->job->title }}</td>
                        <td>{{ $application->job->location }}</td>
                        <td>{{ $application->job->company->name }}</td>
                        <td>
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
                        <td>
                            @if($application->user->resume)
                                <a href="{{ asset('storage/cvs/' . $application->user->resume) }}" target="_blank">Megtekintés</a>
                            @else
                                <span>Nincs feltöltve</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Biztosan törölni szeretnéd a jelentkezésed?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    Törlés
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-app-layout>