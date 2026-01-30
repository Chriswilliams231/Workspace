<x-layout>
    <h1>Avaiable Jobs</h1>
    <ul>
        @forelse($jobs as $job)
        <li>
            {{$job['title']}} - {{$job['description']}}
        </li>
        @empty
        <li>No jobs avaiable</li>
        @endforelse
    </ul>
</x-layout>  