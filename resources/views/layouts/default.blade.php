<html>
<head>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
</head>


<body class="antialiased" x-data="{showAdvancedFilters:false}">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
        <div class="flex flex-wrap justify-between items-center bg-orange-500">
            <!-- Title bar -->
            <div class="flex justify-start items-center ">
                <a href="{{route('psslog.index')}}" class="flex items-center justify-between ml-4 mr-4 text-xl text-white">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
                        Jefferson Lab PSS eStamp Logbook
                    </span>
                </a>

            </div>
            <x-bladewind::dropmenu trigger="bars-3-icon" hide_after_click="false"
                    trigger_css="text-xl text-white mr-3">
                <x-bladewind::dropmenu-item>
                    <div class="align-middle justify-between">
                    <input type="checkbox" :checked="showAdvancedFilters" @change="showAdvancedFilters = ! showAdvancedFilters"
                           class="w-4 h-4 mr-2 ml-1  text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                    Show Complex Filters
                    </div>
                </x-bladewind::dropmenu-item>
            </x-bladewind::dropmenu>

        </div>
    </nav>

    <!-- Main Page Content -->
    @yield('main')

</body>
</html>
