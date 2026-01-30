<x-layout>
    <h1>Avaiable Jobs</h1>
    <ul>
        @forelse($jobs as $job)
        <li>
           <a href="{{route('jobs.show', $job->id)}}"> {{$job['title']}}</a> - {{$job['description']}}
        </li>
        @empty
        <li>No Jobs Avaiable</li>
        @endforelse
    </ul>
</x-layout>  