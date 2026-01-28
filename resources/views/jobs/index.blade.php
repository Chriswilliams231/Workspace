<x-layout>
    <h1>Avaiable Jobs</h1>
    @if(!empty($jobs))
    <ul>
        @foreach($jobs as $job)
        <li>
            {{$job}}
        </li>
        @endforeach
    </ul>
    @else
    <p>No jobs avaiable</p>
    @endif
</x-layout>  