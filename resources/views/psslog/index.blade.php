@extends('layouts.default')

@section('main')
    <div class="flex flex-wrap w-100">

        <main class="p-4 pt-10 w-full sm:w-2/3 md:w-3/4">
            <!-- The table of open accesses -->
            @if ($accesses->count() > 0)
                @include('psslog.accesses_table',['title' => 'Open Accesses', 'entries' => $accesses, 'mode' => 'brief'])
            @endif
            <!-- The listing of psslog entry titles -->
            @include('psslog.entries')
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
                @include('layouts.sidebar_links')
            </div>

        </aside>

    </div>
@stop
