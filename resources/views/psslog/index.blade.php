@extends('layouts.default')

@section('main')
    <div class="flex flex-wrap w-100">

        <main class="p-4 mt-14 w-full sm:w-2/3 md:w-3/4">
            <!-- The table of open accesses -->
            <div id="open-accesses-container" hx-get="{{route('accesses.open')}}" hx-trigger="every 1m" hx-swap="innerHTML">
            @if ($accesses->count() > 0)
                @include('psslog.accesses_table',['title' => 'Open Accesses', 'entries' => $accesses, 'mode' => 'brief'])
            @endif
            </div>
            <!-- The listing of psslog entry titles -->
            {{request()->fullUrl()}}
            <div id="psslog-listing-container" hx-get="{{route('psslog.list')}}" hx-trigger="every 1m" hx-swap="innerHTML">
                @include('psslog.entries')
            </div>
            {!! $paginatorLinks !!}
        </main>

        <!-- Sidebar -->
        <aside
            class="right-0 w-80 pt-14  bg-white dark:bg-gray-800 dark:border-gray-700"
            aria-label="Sidenav"
            id="drawer-navigation"
        >
            <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
                @include('layouts.sidebar_datepicker')
                @include('layouts.sidebar_filters')
                @include('layouts.sidebar_links')
            </div>

        </aside>

    </div>
@stop
