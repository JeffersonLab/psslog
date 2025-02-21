@if ($entries->first() instanceof \Illuminate\Support\Collection)
{{--The case where we've got grouped entries--}}
@foreach($entries as $heading => $subset)
    <h2 class="mt-2">{{$heading}}</h2>
    @include('psslog.entries_table',['entries' => $subset,'showDate' => false])
@endforeach
@else
    {{--The case where we've got a flat list of entries--}}
    @include('psslog.entries_table',['entries' => $entries,'showDate' => true])
@endif

