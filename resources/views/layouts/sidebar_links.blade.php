<!-- Docs -->
<div class="flex flex-col w-78 mt-5 bg-gray-100 break-words bg-clip-border border-[1px] border-[solid] rounded">
    <h2>
        <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium  text-gray-500 border border-b-0 border-gray-200 rounded focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                aria-controls="accordion-collapse-body-1">
            <svg
                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                <path
                    fill-rule="evenodd"
                    d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                    clip-rule="evenodd"
                ></path>
            </svg>

            <span>Docs</span>
            <span></span>
        </button>

    </h2>
    <ul class="list-disc text-blue-500 p-8 bg-white border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
        @foreach(config('settings.sidebar_docs') as $title => $link)
            <li>
                <a class="hover:underline" target="_blank"
                   href="{{$link}}">
                    {{$title}}
                </a>
            </li>
    @endforeach
</div>

<!-- Links -->
<div class="flex flex-col w-78 mt-5 bg-gray-100 break-words bg-clip-border border-[1px] border-[solid] rounded">
    <h2>
        <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                aria-controls="accordion-collapse-body-1">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                 fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961"/>
            </svg>

            <span>Links</span>
            <span></span>
        </button>

    </h2>
    <ul class="list-disc text-blue-500 p-8 bg-white border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
        @foreach(config('settings.sidebar_links') as $title => $link)
            <li>
                <a class="hover:underline" target="_blank"
                   href="{{$link}}">
                    {{$title}}
                </a>
            </li>
    @endforeach
</div>

</div>
