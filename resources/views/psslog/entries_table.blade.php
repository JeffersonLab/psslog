<div class="psslog-entries" class="shadow-md sm:rounded-lg">
    <table class="min-w-full table-auto text-xs text-left  text-gray-900 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-0 py-1">
                PSSLog ID
            </th>
            <th scope="col" class="px-0 py-1">
                Time
            </th>
            <th scope="col" class="px-0 py-1">
                Area
            </th>
            <th scope="col" class="px-0 py-1">
                Type
            </th>
            <th scope="col" class="px-0 py-1">
                User
            </th>
            <th scope="col" class="px-0 py-1">
                Title
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($entries as $entry)
        <tr class="odd:bg-white  even:bg-yellow-100 border-b border-gray-200">
            <td>{{$entry->psslog_id}}</td>
            <td>{{$entry->entry_timestamp}}</td>
            <td>{{$entry->area}}</td>
            <td>{{$entry->entry_type}}</td>
            <td>{{$entry->entry_maker}}</td>
            <td>{{$entry->title}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

