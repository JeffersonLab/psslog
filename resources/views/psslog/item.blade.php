@extends('layouts.default')

@section('main')
    <div class="flex flex-wrap">
        <main class="p-4 pt-10 w-full sm:w-2/3 md:3/4">
        <div id="psslog-with-links">
            <div class="hidden" id="item-links" >
                <a id="item-links-previous" href="{{$previousUrl}}">previous</a>
                <a id="item-links-next" href="{{$nextUrl}}">next</a>
            </div>
            <div id="item-content">
                @if ($psslog->entry_type == 'STAMP')
                    @if ($psslog->stampType() == 'CONTROLLED')
                        @include('psslog.controlled_stamp')
                    @elseif ($psslog->stampType() == 'RESTRICTED')
                        @include('psslog.restricted_stamp')
                    @elseif ($psslog->stampType() == 'SWEEP')
                        @include('psslog.sweep_stamp')
                    @else
                        @include('psslog.stamp')
                    @endif
                @else
                    @include('psslog.info')
                @endif
            </div>
        </div>
        </main>

        <!-- Sidebar -->
        <aside
            class="right-0 min-w-80 pt-10  bg-white dark:bg-gray-800 dark:border-gray-700"
        >
            <div
                class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
                @include('layouts.prev_next')
                @include('layouts.sidebar_links')
            </div>

        </aside>
    </div>
@stop
