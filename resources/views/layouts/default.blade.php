<html>
<head>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>


<body class="antialiased">

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

        </div>
    </nav>

    <!-- Main Page Content -->
    @yield('main')

</body>
</html>
