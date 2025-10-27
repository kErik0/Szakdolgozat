<x-app-layout>
        <div>
            
            @if(session('success'))
                <div>
                    {{ session('success') }}
                </div>
            @endif

            <div>
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th>Cím</th>
                                <th>Hely</th>
                                <th>Bérezés</th>
                                <th>Műveletek</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job)
                                <tr>
                                    <td>{{ $job->title }}</td>
                                    <td>{{ $job->location }}</td>
                                    <td>{{ number_format($job->salary, 0, ',', ' ') }} Ft</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('jobs.applications', $job->id) }}">
                                                Jelentkezettek
                                            </a>
                                            <a href="{{ route('jobs.edit', $job->id) }}">
                                                Szerkesztés
                                            </a>
                                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Biztosan törölni szeretnéd?')">
                                                    Törlés
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-app-layout>
