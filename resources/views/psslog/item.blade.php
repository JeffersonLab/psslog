@extends('layouts.default')

@section('main')
    <div class="flex flex-wrap grid-cols-2 w-100">
        <main class="p-4 grow pt-10 col">
            @if ($psslog->entry_type == 'STAMP')
                @if ($psslog->stampType() == 'CONTROLLED')
                    @include('psslog.controlled_stamp')
                @endif
            @else
                <div>
                    Not a Stamp!
                </div>
            @endif
        </main>


        <!-- Sidebar -->
        <aside
            class="col right-0 w-80 pt-10  bg-white dark:bg-gray-800 dark:border-gray-700"
            aria-label="Sidenav"
            id="drawer-navigation"
        >
            <div
                class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
                @include('layouts.sidebar_links')
            </div>

        </aside>
    </div>
@stop
