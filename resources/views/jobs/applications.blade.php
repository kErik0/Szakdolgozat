<x-app-layout>
    @if($applications->count() > 0)
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Név</th>
                        <th>Email</th>
                        <th>Státusz</th>
                        <th>CV</th>
                        <th>Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $application)
                        <tr>
                            <td>{{ $application->user->name }}</td>
                            <td>{{ $application->user->email }}</td>
                            <td>
                                @if($application->status === 'pending')
                                    Függőben
                                @elseif($application->status === 'accepted')
                                    Elfogadva
                                @elseif($application->status === 'rejected')
                                    Elutasítva
                                @else
                                    {{ ucfirst($application->status) }}
                                @endif
                            </td>
                            <td>
                                @if($application->user->resume)
                                    <a href="{{ asset('storage/cvs/' . $application->user->resume) }}" target="_blank">Megtekintés</a>
                                @else
                                    <span>Nincs feltöltve</span>
                                @endif
                            </td>
                            <td>
                                @if($application->status === 'accepted' || $application->status === 'rejected')
                                    <form action="{{ route('applications.destroy', $application->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Törlés</button>
                                    </form>
                                @else
                                    <form action="{{ route('applications.accept', $application->id) }}" method="POST">
                                        @csrf
                                        <button type="submit">Elfogad</button>
                                    </form>
                                    <form action="{{ route('applications.reject', $application->id) }}" method="POST">
                                        @csrf
                                        <button type="submit">Elutasít</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>Nincsenek jelentkezések ehhez az álláshoz.</p>
    @endif
</x-app-layout>