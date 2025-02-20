@extends('layouts.default')

@section('main')

<div class="flex flex-wrap mt-5">
@if ($psslog->entry_type == 'STAMP')
    @if ($psslog->stampType() == 'CONTROLLED')
        @include('psslog.controlled_stamp')
    @endif
@else
    Not a Stamp!
@endif
</div>

@stop
