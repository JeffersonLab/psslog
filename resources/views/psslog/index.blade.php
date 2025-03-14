@extends('layouts.default')

@section('main')
    <div class="flex flex-wrap w-100">
        <main class="p-4 mt-14 flex-grow">
            <!-- The table of open accesses -->
            <div id="open-accesses-container" hx-get="{{route('accesses.open')}}" hx-trigger="every 1m" hx-swap="innerHTML">
            @if ($accesses->count() > 0)
                @include('psslog.accesses_table',['title' => 'Open Accesses', 'entries' => $accesses, 'mode' => 'brief'])
            @endif
            </div>

            @include('psslog.complex_filters')

            <!-- The listing of psslog entry titles -->
            <div id="psslog-listing-container" hx-get="{{route('psslog.list',$filters)}}" hx-trigger="every 5m" hx-swap="innerHTML">
                @include('psslog.entries')
            </div>
{{--            {{dd($paginatorLinks)}}--}}
            {!! $paginatorLinks !!}
        </main>

        <!-- Sidebar -->
        <aside
            class="right-0 min-w-84 pt-14  bg-white dark:bg-gray-800 dark:border-gray-700"
            aria-label="Sidenav"
            id="drawer-navigation"
        >
            <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
                @include('layouts.sidebar_filters')
                @include('layouts.sidebar_links')
            </div>

        </aside>

    </div>
@stop
